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
            $CustomerIfExits = Customer::where("email", $Email )->where("company_id",session("CompanyLinkID"))->count();
            if( $CustomerIfExits > 0 )
                $Customer = Customer::where("email", $Email)->where("company_id",session("CompanyLinkID"))->first();
            else {
                $Customer = new Customer();
                $Customer->company_id = session("CompanyLinkID");
                $Customer->email = $Email;
                $Customer->name = $InviteObj->name;
            }

            $Conuntry = Country::orderBy("name")->get();
            $VehicleTypes = DB::table('vehicles')
                        ->selectRaw('upper(car_type) as car_type')
                        ->where("company_id",session("CompanyLinkID"))
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get();
            //Log::info(json_encode($VehicleTypes));

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
                ($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->email == $Input["email"])
                || ($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
                || ($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->dob == $Input["dob"])
                || ($Cms->email == $Input["email"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
                || ($Cms->email == $Input["email"] && $Cms->dob == $Input["dob"])
                || ($Cms->dob == $Input["dob"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
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
            $CustObj->title = $Input["title"];
            $CustObj->first_name = $Input["first_name"];
            $CustObj->middle_name = $Input["middle_name"];
            $CustObj->last_name = $Input["last_name"];
            $CustObj->permanent_address = $Input["permanent_address"];
            $CustObj->temp_address = $Input["temp_address"];
            $CustObj->nationality = $Input["nationality"];
            $CustObj->gender = $Input["gender"];
            $CustObj->dob = $Input["dob"];
            $CustObj->country_code = $Input["country_code"]; 
            //$CustObj->mobile = "+".$Input["country_code"].$Input["mobile"];
            $CustObj->mobile = $Input["mobile"];
            $CustObj->email = $Input["email"];
            $CustObj->insurance = $Input["insurance"];

            if($request->file('residency_card') != null){
                $path = $request->file('residency_card')->store('CustomersImages');
                $CustObj->residency_card = $path;
            }

            if($request->file('driving_license') != null){
                $path = $request->file('driving_license')->store('CustomersImages');
                $CustObj->driving_license = $path;
            }

            if($request->file('passport_detail') != null){
                $path = $request->file('passport_detail')->store('CustomersImages');
                $CustObj->passport_detail = $path;
            }

            if($request->file('visa_detail') != null){
                $path = $request->file('visa_detail')->store('CustomersImages');
                $CustObj->visa_detail = $path;
            }

            $CustObj->save();
            $CustomerID = $CustObj->id;
            Log::info('customer id: '.$CustomerID);
        }

        date_default_timezone_set("Asia/Muscat");# setting current time zone
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
            $requirements["tarrif_type"] = $Input["tarrif_type"];
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

            
            $MultiplyDay = 1;
            if($Input["tarrif_type"] == "Weekly"){
                $MultiplyDay = 7;
            }
            if($Input["tarrif_type"] == "Monthly"){
                $MultiplyDay = 30;
            }
    
            $Day = $Input["tarrif_detail"] * $MultiplyDay;
            $DopDate = date("Y-m-d H:i:s", strtotime("+".$Day." days", strtotime($Input["PickupDate"])));
            
            $GetPricing = Pricing::where("car_type", $Input["vehicle_id"])->where("company_id", $InviteObj->company_id)->first();
    
            $BasePrice = 0;
            if($Input["tarrif_type"] == "Daily"){
                if(isset($GetPricing->daily_pricing)){
                    $BasePrice = $GetPricing->daily_pricing;
                }
            }
    
            if($Input["tarrif_type"] == "Weekly"){
                if(isset($GetPricing->weekly_pricing)){
                    $BasePrice = $GetPricing->weekly_pricing;
                }
            }
    
            if($Input["tarrif_type"] == "Monthly"){
                if(isset($GetPricing->monthly_pricing)){
                    $BasePrice = $GetPricing->monthly_pricing;
                }
            }
    
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

    public function Exports(){
        $Data = Customer::where("company_id", session("CompanyLinkID"))->latest()->get();
        return Excel::download(new CustomerExport($Data), 'Customer.xlsx');
    }

    public function Search(Request $request){
        $Cust = Customer::where("company_id", session("CompanyLinkID"))->where(function($q)use ($request) {
                    $q->where("mobile", "like", "%".$request->term."%")->orWhere("email", "like", "%".$request->term."%");
                })->first();

        if(isset($Cust->id)){
            return json_encode($Cust);
        }else{
            return json_encode(array());
        }
    }
}
