<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Mail;
use Excel;

use App\Models\Customer;
use App\Models\Admin;
use App\Models\BookingInvite;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Pricing;
use App\Models\Office;
use App\Export\CustomerExport;
use App\Models\CustomerImages;

use Log;
use DB;

class CustomerController extends Controller
{
    protected $logger ;

    public function register($id){
        $Email = base64_decode($id);
        $CheckInvite = BookingInvite::where("email", $Email)->where("status", 0)->count();
        if($CheckInvite == 0){
            return redirect("404");
        }else{
            $InviteObj = BookingInvite::where("email", $Email)->where("status", 0)->first();
            // $CustomerIfExits = Customer::where("email", $Email )->where("company_id",session("CompanyLinkID"))->count();
            // if( $CustomerIfExits > 0 )
            //     $Customer = Customer::where("email", $Email)->where("company_id",session("CompanyLinkID"))->first();
            // else {
                $Customer = new Customer();
                $Customer->company_id = session("CompanyLinkID");
                $Customer->email = $Email;
                $Customer->first_name = $InviteObj->name;
            // }

            $Conuntry = Country::orderBy("name")->get();
            $VehicleTypes = DB::table('vehicles')
                        ->selectRaw('car_type as car_type')
                        ->where("company_id",session("CompanyLinkID"))  //TODO remove session information from here.. store this info in invite only.. 
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get();

            return view("CustomerRegister", compact("InviteObj", "Customer" , "Conuntry", "VehicleTypes"));
        }
    }

    public function registerPost(Request $request){
        $Input = $request->all();
        $CustomerID = "";
        $InviteObj = BookingInvite::where("email", $Input["email"])->where("status", 0)->first();
        $CheckCustomer = Customer::where("company_id", $InviteObj->company_id)->get();
        $CustomerFound = 0;
        
        foreach($CheckCustomer as $Cms){
            if(
                ($Cms->first_name == $Input["first_name"] && $Cms->email == $Input["email"])
                || ($Cms->first_name == $Input["first_name"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
                || ($Cms->first_name == $Input["first_name"] && $Cms->dob == $Input["dob"])
                // || ($Cms->email == $Input["email"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
                // || ($Cms->email == $Input["email"] && $Cms->dob == $Input["dob"])
                // || ($Cms->dob == $Input["dob"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
            ){
                $CustomerFound = 1;
            }
            
            if($CustomerFound == 1){
                $CustomerID = $Cms->id;
                break;
            }
        }

        //create new customer if id is null.. else update data.
        if($CustomerID == ""){
            
            if($request->file('driving_license') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Driving License File"));
            }

            if($request->file('passport_detail') == null && $request->file('residency_card') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Passport File or Residency Card"));
            }
            
            $GetCompanyDetail = Office::find($InviteObj->company_id);
            $PreviousCode = Customer::where("company_id", $InviteObj->company_id)->orderBy("id", "DESC")->first();
            
            if(isset($PreviousCode->customer_id) && $PreviousCode->customer_id != ""){
                $GetInt = explode("-", $PreviousCode->customer_id);
                $GetInt = $GetInt[1];
            }else{
                $GetInt = 0;
            }
            
            $NewCode = substr($GetCompanyDetail->name, 0, 2)."-".($GetInt+1);

            $CustObj = new Customer();
            $CustObj->company_id = $InviteObj->company_id;
            $CustObj->customer_id = $NewCode;
            $CustObj = updateCustomerDetails($Input, $CustObj);
            $CustObj->save();

            $CustomerID = $CustObj->id;            
            Log::info('customer id: '.$CustomerID);
        }else{
            Log::debug("customercontroller old CustomerID - ".$CustomerID);
            $UpdatedInput = $this->unset_variables($Input);
            Customer::where('id', $CustomerID)->update($UpdatedInput);
            $Customer = Customer::find($CustomerID);
            Log::debug("customercontroller updated dob  - ".$Customer->dob);
        }


       $fileTypes = array('residency_card','passport_detail','visa_detail','driving_license');
       foreach($fileTypes as $filetype) {
            if($request->file($filetype) && sizeof($request->file($filetype)) > 0){
                CustomerImages::where('customer_id',$CustomerID)->delete();   //delete only when there are new documents from client
                for($i = 0; $i < sizeof($request->file($filetype)); $i++ ){
                    Log::debug("type - " . $filetype . " , i - ". $i);
                    $CustImages = new CustomerImages();
                    $CustImages->customer_id = $CustomerID;
                    $CustImages->company_id = session("CompanyLinkID");
                    $CustImages->type = $filetype;

                    $path = $request->file($filetype)[$i]->store('CustomersImages');
                    $CustImages->link = $path;
                    $CustImages->save();
                }
            }    
       }

        date_default_timezone_set("Asia/Muscat");# setting current time zone  ///  TODO this is hack fix it putting this property in settings
        
        if($Input["PickupDate"]." ".$Input["PickupTime"] < date("Y-m-d H:i:s")){
            return json_encode(array("Status" =>  0, "Message" => "Pickup Date Can't Be in Past"));
        }

        if($Input["dob"]." ".$Input["dob"] > date('Y-m-d', strtotime('-18 year'))){
            return json_encode(array("Status" =>  0, "Message" => "Date Of Birth Can't Be Less Than 18 Years"));
        }

        if(isset($InviteObj->status)){
            $UserData = Admin::find($InviteObj->user_id);
            $Email = $UserData->email;
           
            $requirements["car_type"] = $Input["vehicle_id"];
            $requirements["tarrif_detail"] = $Input["tarrif_detail"];
            #$requirements["tarrif_type"] = $Input["tarrif_type"];
            $requirements["PickupDate"] = $Input["PickupDate"];
            $requirements["PickupTime"] = $Input["PickupTime"];
            $requirements["pickup_location"] = $Input["pickup_location"];
            $requirements["payment_mode"] = $Input["payment_mode"];
            $requirements["tarrif_detail"] = $Input["tarrif_detail"];
            
            $req="";
            foreach($requirements as $key => $value){
                $req.=($key."=".$value."|");
            }
            
            $InviteObj["requirements"] = $req;

            
            #$MultiplyDay = 1;
            #if($Input["tarrif_type"] == "Weekly"){
             #   $MultiplyDay = 7;
           # }
           # if($Input["tarrif_type"] == "Monthly"){
               # $MultiplyDay = 30;
          #  }
    
            #$Day = $Input["tarrif_detail"] * $MultiplyDay;
            $Day = $Input["tarrif_detail"] ;
            $DopDate = date("Y-m-d H:i:s", strtotime("+".$Day." days", strtotime($Input["PickupDate"])));
            
            $GetPricing = Pricing::where("car_type", $Input["vehicle_id"])->where("company_id", $InviteObj->company_id)->first();
    
            $DailyPrice = $WeeklyPrice = $MonthlyPrice = 0;
            //if($Input["tarrif_type"] == "Daily"){
                if(isset($GetPricing->daily_pricing)){
                    $DailyPrice = $GetPricing->daily_pricing;
                }
            //}
    
            //if($Input["tarrif_type"] == "Weekly"){
                if(isset($GetPricing->weekly_pricing)){
                    $BasePrice = $GetPricing->weekly_pricing;
                }
            //}
    
            //if($Input["tarrif_type"] == "Monthly"){
                if(isset($GetPricing->monthly_pricing)){
                    $MonthlyPrice = $GetPricing->monthly_pricing;
                }
           // }
    
            $InviteObj->customer_id = $CustomerID;
            $InviteObj->status = 1;
            $InviteObj->link = "";//set invite link to null once customer submits registration for booking.
            $InviteObj->save();

            Log::info('invite object status 1 save.');

            $NotiObj = new Notification();
            $NotiObj->title = "New Customer Registration";
            $NotiObj->desp = $Input["first_name"]." is register from your invite link";
            $NotiObj->linked_id = null;
            $NotiObj->module = "booking";
            $NotiObj->user_id = $InviteObj->user_id;
            $NotiObj->save();
            
            $data = array("Name" => $UserData->name, "Customer" => $InviteObj->name);
            Mail::send("EmailTemplates.CustomerRegister", $data, function ($m) use($Email, $InviteObj){
                $m->from($InviteObj->email, $InviteObj->name);
                $m->to($Email)->subject("Customer Register Successfully");
            });

        } else {
            Log::info("invite object status not set error... ");
            return json_encode(array("Status" =>  0, "Message" => "Registeration Fail. Contact company"));
        }

        return json_encode(array("Status" =>  1, "Message" => "Register Successfully"));
    }
    
    public function index(){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Data = Customer::where("company_id", session("CompanyLinkID"))->latest()->get();
        $ActiveAction = "customer";
        return view('customer.view', compact("Data", "ActiveAction"));
    }

    function updateCustomerDetails($Input, $CustObj){
        $CustObj->title = $Input["title"];
        $CustObj->first_name = $Input["first_name"];
        //$CustObj->middle_name = $Input["middle_name"];
        $CustObj->last_name = NULL;  // this is hack.. TODO  need to be fixed.
        $CustObj->permanent_address = $Input["permanent_address"];
        $CustObj->temp_address = $Input["temp_address"];
        $CustObj->nationality = $Input["nationality"];
        $CustObj->gender = $Input["gender"];
        $CustObj->dob = $Input["dob"];
        $CustObj->country_code = $Input["country_code"];
        $CustObj->mobile = $Input["mobile"];
        $CustObj->email = $Input["email"];
        $CustObj->insurance = $Input["insurance"];

        return $CustObj;
    }

    public function saveCustomerImages(Request $request){
            //this section has to be in separte api... upload files.. 
               CustomerImages::where("company_id",session("CompanyLinkID"))->where('customer_id',$CustomerID)->delete();    //right now disabled file deleteion.  TODO fix this behavior

               $fileTypes = array('residency_card','passport_detail','visa_detail','driving_license');
               foreach($fileTypes as $filetype) {
                    if($request->file($filetype) && sizeof($request->file($filetype)) > 0){
                        for($i = 0; $i < sizeof($request->file($filetype)); $i++ ){
                            Log::debug("type - " . $filetype . " , i - ". $i);
                            $CustImages = new CustomerImages();
                            $CustImages->customer_id = $CustomerID;
                            $CustImages->company_id = session("CompanyLinkID");
                            $CustImages->type = $filetype;
        
                            $path = $request->file($filetype)[$i]->store('CustomersImages');
                            $CustImages->link = $path;
                            $CustImages->save();
                        }
                    }    
               }
    }

    public function create(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Customer = new Customer();
        $CustImagesArr = [];
        $Conuntry = Country::orderBy("name")->get();

        $ActiveAction = "customer";
        return view('customer.add', compact("Customer", "CustImagesArr","Conuntry", "ActiveAction"));
    }
    
    public function store(Request $request) {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
        $CustomerID = "";
        $CheckCustomer = Customer::where("company_id", session("CompanyLinkID"))->where("email",$Input["email"])->get();
        foreach($CheckCustomer as $Cms){
            if(
                ($Cms->first_name == $Input["first_name"] 
                && $Cms->mobile == $Input["mobile"]) 
                && $Cms->country_code == $Input["country_code"]
                // && $Cms->dob == $Input["dob"]
            ){
                return json_encode(array("Status" =>  0, "Message" => "Customer already exists"));
            }
        }

        $GetCompanyDetail = Office::find(session("CompanyLinkID"));
        $PreviousCode = Customer::where("company_id", session("CompanyLinkID"))->orderBy("id", "DESC")->first();
        
        if(isset($PreviousCode->customer_id) && $PreviousCode->customer_id != ""){
            $GetInt = explode("-", $PreviousCode->customer_id);
            $GetInt = $GetInt[1];
        }else{
            $GetInt = 0;
        }
        
        $NewCode = substr($GetCompanyDetail->name, 0, 2)."-".($GetInt+1);

        $CustObj = new Customer();
        $CustObj->company_id = session("CompanyLinkID");
        $CustObj->customer_id = $NewCode;
        // updateCustomerDetails($Input,$CustObj);
        $CustObj->title = $Input["title"];
        $CustObj->first_name = $Input["first_name"];
        //$CustObj->middle_name = $Input["middle_name"];
        $CustObj->last_name = NULL;  // this is hack.. TODO  need to be fixed.
        $CustObj->permanent_address = $Input["permanent_address"];
        $CustObj->driving_license = NULL;  // this is hack.. TODO  need to be fix
        $CustObj->temp_address = $Input["temp_address"];
        $CustObj->nationality = $Input["nationality"];
        $CustObj->gender = $Input["gender"];
        $CustObj->dob = $Input["dob"];
        $CustObj->country_code = $Input["country_code"];
        $CustObj->mobile = $Input["mobile"];
        $CustObj->email = $Input["email"];
        $CustObj->insurance = $Input["insurance"];

        
        $CustObj->save();
        
        $fileTypes = array('residency_card','passport_detail','visa_detail','driving_license');
        foreach($fileTypes as $filetype) {
             if($request->file($filetype) != NULL && sizeof($request->file($filetype)) > 0){
                 for($i = 0; $i < sizeof($request->file($filetype)); $i++ ){
                     Log::debug("type - " . $filetype . " , i - ". $i);
                     $CustImages = new CustomerImages();
                     $CustImages->customer_id = $CustObj->id;
                     $CustImages->company_id = session("CompanyLinkID");
                     $CustImages->type = $filetype;
 
                     $path = $request->file($filetype)[$i]->store('CustomersImages');
                     $CustImages->link = $path;
                     $CustImages->save();
                 }
             }    
        }


        Log::debug("Customer created. Id - ".$CustObj->id); 
        $ActiveAction = "customer";

        $data = array("customer_id" => $CustObj->id);
        return json_encode(array("Status" =>  1, "Message" => "Customer created successfully", "Data" => $data));
        // return redirect("customer/".$CustObj->id."/edit");
    }

    public function edit($id){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Customer = null;
        $CustImagesArr = [];

        if ($id != null) {
            $Customer = Customer::find($id);
            $Conuntry = Country::orderBy("name")->get();

            $ActiveAction = "customer";
            return view('customer.edit', compact("Customer", "CustImagesArr","Conuntry", "ActiveAction"));
        } else {
            return json_encode(array("Status" =>  0, "Message" => "Customer not found"));
        }
    }

    public function update(Request $request, $id) {
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Input = $request->all();

        if($id == null || $id == "") {
            $GetCompanyDetail = Office::find(session("CompanyLinkID"));
            $PreviousCode = Customer::where("company_id", session("CompanyLinkID"))->orderBy("id", "DESC")->first();
            
            if(isset($PreviousCode->customer_id) && $PreviousCode->customer_id != ""){
                $GetInt = explode("-", $PreviousCode->customer_id);
                $GetInt = $GetInt[1];
            }else{
                $GetInt = 0;
            }
            
            $NewCode = substr($GetCompanyDetail->name, 0, 2)."-".($GetInt+1);

            $CustObj = new Customer();
            $CustObj->company_id = session("CompanyLinkID");        
            $CustObj->customer_id = $NewCode;
            $CustObj = updateCustomerDetails($Input, $CustObj);
            $CustObj->save();

            $fileTypes = array('residency_card','passport_detail','visa_detail','driving_license');
            foreach($fileTypes as $filetype) {
                 if($request->file($filetype) && sizeof($request->file($filetype)) > 0){
                     for($i = 0; $i < sizeof($request->file($filetype)); $i++ ){
                         Log::debug("type - " . $filetype . " , i - ". $i);
                         $CustImages = new CustomerImages();
                         $CustImages->customer_id = $CustomerID;
                         $CustImages->company_id = session("CompanyLinkID");
                         $CustImages->type = $filetype;
     
                         $path = $request->file($filetype)[$i]->store('CustomersImages');
                         $CustImages->link = $path;
                         $CustImages->save();
                     }
                 }    
            }
    
            $CustomerID = $CustObj->id;
            return json_encode(array("Status" =>  1, "Message" => "Customer added successfully"));
        } else {
            $Customer = Customer::find($id);
            
            if($Customer == null )            
                return json_encode(array("Status" =>  404, "Message" => "Customer not found"));
            
            $UpdatedInput = $this->unset_variables($Input);
            Log::debug($UpdatedInput); //just check what is there.. 
            Customer::where("company_id",session("CompanyLinkID"))->where('id', $Customer->id)->update($UpdatedInput);
            $fileTypes = array('residency_card','passport_detail','visa_detail','driving_license');
            foreach($fileTypes as $filetype) {
                 if($request->file($filetype) && sizeof($request->file($filetype)) > 0){
                     for($i = 0; $i < sizeof($request->file($filetype)); $i++ ){
                         Log::debug("type - " . $filetype . " , i - ". $i);
                         $CustImages = new CustomerImages();
                         $CustImages->customer_id = $Customer->id;
                         $CustImages->company_id = session("CompanyLinkID");
                         $CustImages->type = $filetype;
     
                         $path = $request->file($filetype)[$i]->store('CustomersImages');
                         $CustImages->link = $path;
                         $CustImages->save();
                     }
                 }    
            }
            return json_encode(array("Status" =>  1, "Message" => "Customer updated successfully"));
        }
    }
    
    public function Exports(){
        $Data = Customer::where("company_id", session("CompanyLinkID"))->latest()->get();
        return Excel::download(new CustomerExport($Data), 'Customer.xlsx');
    }

    public function Search(Request $request){
        $CustList = Customer::where("company_id", session("CompanyLinkID"))->where(function($q)use ($request) {
                    $q->where("mobile", "like", "%".$request->term."%")->orWhere("email", "like", "%".$request->term."%");
                })->get();
        $CustArray = [];
        foreach($CustList as $Cust){
            $Cust_details = array("id" => $Cust->id, "name" => $Cust->first_name, "email" => $Cust->email, "mobile" => "(+".$Cust->country_code.") ".$Cust->mobile);
            array_push($CustArray, $Cust_details);
        }

        return json_encode(array(
                "Status" =>  1
                , "Message" => ""
                , "Data" => $CustArray
            ));
    }

    public function Get(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Cust = Customer::where("company_id", session("CompanyLinkID"))->where("id",$request->id)->get();
        return response()->json($Cust);
    }

    public function getImages(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 

        $CustImages = CustomerImages::where("company_id", session("CompanyLinkID"))->where('customer_id',$request->customer_id)->get();
        $response = [];
		foreach($CustImages as $Img){
            if (!isset($response[$Img->type])){
                $response[$Img->type] = [];
            }
            $img_details = array("id" => $Img->id, "link" => $Img->link);
            array_push($response[$Img->type],$img_details);
        }

        Log::debug($response);
        return json_encode(array(
            "Status" =>  1
            , "Message" => ""
            , "Data" => $response
        ));
    }

    public function uploadFiles(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        // Log::debug(sizeof($request->file('files'))); //just check what is there.. 
        // Log::debug($Input); //just check what is there.. 

        $responseData = array();
        $filetype = $Input['type'];
        $customerId = $Input['customer_id'];

        if($request->file('files') && sizeof($request->file('files')) > 0){
            for($i = 0; $i < sizeof($request->file('files')); $i++ ){
                $CustImages = new CustomerImages();
                $CustImages->customer_id = $customerId;
                $CustImages->company_id = session("CompanyLinkID");
                $CustImages->type = $filetype;

                $path = $request->file('files')[$i]->store('CustomersImages');
                $CustImages->link = $path;
                $CustImages->save();
                
                //add to response
                if (!isset($responseData[$filetype])){
                    $responseData[$filetype] = [];
                }
                $img_details = array("id" => $CustImages->id, "link" => $CustImages->link);
                array_push($responseData[$filetype],$img_details);
            }
        }    

        return json_encode(array("Status" =>  1, "Message" => "files updated successfully", "Data" => $responseData));
    }

    public function deleteFile(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
    
        $CustImages = CustomerImages::where("company_id", session("CompanyLinkID"))
                        ->where('customer_id',$Input['customer_id'])
                        ->where('id',$Input['image_id'])
                        ->delete();

        return json_encode(array("Status" =>  1, "Message" => "file deleted successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function delete(Request $request)
    {
        try {

            if(session("AdminID") == ""){
                return redirect("/");
            }
    
            $Input = $request->all();
            Log::debug("Input id  - ".$Input["id"]);
            Customer::find($Input["id"])->delete();
            $response = array("status"=>"success");    
        } catch (Exception $e){
            $response = array("status"=>"Error");
        }

        return json_encode($response);
    }

    function unset_variables($Input){
        $UpdatedInput = $Input;
        unset($UpdatedInput["_token"]);
        unset($UpdatedInput["PickupDate"]);
        unset($UpdatedInput["PickupTime"]);
        unset($UpdatedInput["tarrif_detail"]);
        unset($UpdatedInput["vehicle_id"]);
        unset($UpdatedInput["pickup_location"]);
        unset($UpdatedInput["km_allocation"]);
        unset($UpdatedInput["payment_mode"]);
        unset($UpdatedInput["additional_info"]);
        unset($UpdatedInput["booking_note"]);
        unset($UpdatedInput["discount_amount"]);
        unset($UpdatedInput["additional_kilometers_amount"]);
        unset($UpdatedInput["invite_id"]);
        return $UpdatedInput;
    }
}
