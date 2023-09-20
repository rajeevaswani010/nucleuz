<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Session;
use Mail;
use Excel;

use App\Export\BookingExport;
use App\Models\Vehicle;
use App\Models\Pricing;
use App\Models\Country;
use App\Models\Booking;
use App\Models\BookingInvite;
use App\Models\Customer;
use App\Models\CustomerImages;
use App\Models\BookingImages;
use App\Models\Office;
use App\Models\CarType;

use Log;
use DB;

use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $GetAllVehicleTypes = CarType::get();
        Log::debug("Booking page index filters ---- vehicle type: ".$request->vehicle_type
                    ." , from: ".$request->from_date
                    ." , to: ".$request->to_date
                    ." , status: ".$request->status
                );
        //echo '<pre>';print_r($request->status); echo '</pre>';die();


        $Data = Booking::where("company_id", session("CompanyLinkID"));

        if($request->from_date != ""){
            $Data = $Data->where("pickup_date_time", ">=", $request->from_date." 00:00:00");
        }

        if($request->to_date != ""){
            $Data = $Data->where("pickup_date_time", "<=", $request->to_date." 23:59:59");
        }

        if($request->vehicle_type != ""){
            $Data = $Data->where("car_type", $request->vehicle_type);
        }

        if($request->status != ""){
            $Data = $Data->where("status", $request->status);
        }

        $Data = $Data->orderBy("id", "DESC")->get();
        
        if(isset($request->export) && $request->export == "Export"){
            return Excel::download(new BookingExport($Data), 'Booking.xlsx');
        }

        $ActiveAction = "booking";
        return view('booking.view', compact("Data", "GetAllVehicleTypes", "ActiveAction"));
    }

    public function BookingReciept()
    {
        $bookingreciept = Booking::where([["advance_amount","!=",0]])->whereNotNull('advance_amount')->where("company_id", session("CompanyLinkID"))->get();
        //echo '<pre>';print_r($bookingreciept); echo '</pre>';die();
        $ActiveAction = "bookingreciepts";
        return view('booking.reciepts', compact("bookingreciept","ActiveAction"));
    }


    public function BookingInvoice(){
        //$bookingreciept = Booking::where([["advance_amount","!=",0]])->whereNotNull('advance_amount')->get();
        $bookingreciept = Booking::where("company_id", session("CompanyLinkID"))->orderBy("id", "DESC")->get();
        $ActiveAction = "bookinginvoice";
        return view('booking.invoice', compact("bookingreciept","ActiveAction"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Input = $request->all();
        $CustomerId = null;
        $Requirements = array();
        $InviteId = 0;//default  0 means no invite
        if (array_key_exists("inviteId",$Input)){
            $InviteId = $Input["inviteId"];
            $InviteObj = BookingInvite::where("company_id", session("CompanyLinkID"))->find($InviteId);
            if($InviteObj != null){
                $CustomerId = $InviteObj->customer_id;
                Log::debug("customerid - ".$CustomerId);
                $arr= explode("|", $InviteObj->requirements);
                foreach($arr as $item){
                    $arr2 = explode("=",$item);
                    if(count($arr2)>0){
                        $Requirements[$arr2[0]] = (count($arr2)>1)?$arr2[1]:null;
                    }
                }
            }
        }

        $ActiveAction = "booking";
        $AllVehicles = Vehicle::where("company_id", session("CompanyLinkID"))->get();
        $AllPricing = Pricing::where("company_id", session("CompanyLinkID"))->get();
        $Conuntry = Country::orderBy("name")->get();
        return view('booking.add', compact("ActiveAction", "AllVehicles", "AllPricing", "Conuntry", "Requirements", "CustomerId","InviteId"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
        //$CustomerID = "";
        $CustomerID = $Input["customer_id"];
        $CheckCustomer = Customer::where("company_id", session("CompanyLinkID"))->where("id",$CustomerID)->get();

        if($CheckCustomer->isEmpty())
            return json_encode(array("Status" =>  0, "Message" => "Customer not found"));

        $Customer = Customer::where("company_id", session("CompanyLinkID"))->where("id",$CustomerID)->get();

        // $CustomerFound = 0;
        
        
        if($Input["payment_mode"] == "Card"){
            if($request->file('card_details') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Card Details"));
            }
        }
        
        // foreach($CheckCustomer as $Cms){
        //     if(
        //         ($Cms->first_name == $Input["first_name"] && $Cms->email == $Input["email"])
        //         || ($Cms->first_name == $Input["first_name"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
        //         || ($Cms->first_name == $Input["first_name"] && $Cms->dob == $Input["dob"])
        //         //|| ($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->dob == $Input["dob"])
        //         //|| ($Cms->email == $Input["email"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
        //         //|| ($Cms->email == $Input["email"] && $Cms->dob == $Input["dob"])
        //         //|| ($Cms->dob == $Input["dob"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"])
        //     )
        //     {
        //         $CustomerID = $Cms->id;
        //         break;
        //     }           
        // }
        
        // if( $CustomerID == "" ){
        //     if($request->file('driving_license')[0] == null){
        //         return json_encode(array("Status" =>  0, "Message" => "Upload Driving License File"));
        //     }

        //     if($request->file('passport_detail')[0] == null && $request->file('residency_card')[0] == null){
        //         return json_encode(array("Status" =>  0, "Message" => "Upload Passport File or Residency Card"));
        //     }
            
        //     $GetCompanyDetail = Office::find(session("CompanyLinkID"));
        //     $PreviousCode = Customer::where("company_id", session("CompanyLinkID"))->orderBy("id", "DESC")->first();
            
        //     if(isset($PreviousCode->customer_id) && $PreviousCode->customer_id != ""){
        //         $GetInt = explode("-", $PreviousCode->customer_id);
        //         $GetInt = $GetInt[1];
        //     }else{
        //         $GetInt = 0;
        //     }
            
        //     $NewCode = substr($GetCompanyDetail->name, 0, 2)."-".($GetInt+1);

        //     $CustObj = new Customer();
        //     $CustObj->company_id = session("CompanyLinkID");
        //     $CustObj->customer_id = $NewCode;
        //     $CustObj->title = $Input["title"];
        //     $CustObj->first_name = $Input["first_name"];
        //     //$CustObj->middle_name = $Input["middle_name"];
        //     $CustObj->last_name = NULL;
        //     $CustObj->permanent_address = $Input["permanent_address"];
        //     $CustObj->temp_address = $Input["temp_address"];
        //     $CustObj->nationality = $Input["nationality"];
        //     $CustObj->gender = $Input["gender"];
        //     $CustObj->dob = $Input["dob"];
        //     $CustObj->country_code = $Input["country_code"];
        //     $CustObj->mobile = $Input["mobile"];
        //     $CustObj->email = $Input["email"];
        //     $CustObj->insurance = $Input["insurance"];

        //    $CustObj->save();
        //    $CustomerID = $CustObj->id;

        // }else{
        //     $UpdatedInput = $this->unset_variables($Input);
        //     Log::debug($UpdatedInput); //just check what is there.. 
        //     Customer::where("company_id",session("CompanyLinkID"))->where('id', $CustomerID)->update($UpdatedInput);
        //     $Customer = Customer::find($CustomerID);
        // }


        // if( $Input["invite_id"] == 0 ) {  // TODO this hack has to be removed
        //     Log::debug("invite id is null");

        //     //this section has to be in separte api... upload files.. 
        //     CustomerImages::where("company_id",session("CompanyLinkID"))->where('customer_id',$CustomerID)->delete();    //right now disabled file deleteion.  TODO fix this behavior

        //     //upload files..
        //     if($request->file('residency_card') && sizeof($request->file('residency_card')) > 0){
        //         for($i = 0; $i < sizeof($request->file('residency_card')); $i++ ){
        //             $CustImages = new CustomerImages();
        //             $CustImages->customer_id = $CustomerID;
        //             $CustImages->company_id = session("CompanyLinkID");
        //             $CustImages->type = "residency_card";

        //             $path = $request->file('residency_card')[$i]->store('CustomersImages');
        //             $CustImages->link = $path;
        //             $CustImages->save();
        //         }
        //     }

        //     if($request->file('passport_detail') && sizeof($request->file('passport_detail')) > 0){
        //         for($i = 0; $i < sizeof($request->file('passport_detail')); $i++ ){
        //             $CustImages = new CustomerImages();
        //             $CustImages->customer_id = $CustomerID;
        //             $CustImages->company_id = session("CompanyLinkID");
        //             $CustImages->type = "passport_detail";

        //             $path = $request->file('passport_detail')[$i]->store('CustomersImages');
        //             $CustImages->link = $path;
        //             $CustImages->save();
        //         }
        //     }

        //     if($request->file('driving_license') && sizeof($request->file('driving_license')) > 0){
        //         for($i = 0; $i < sizeof($request->file('driving_license')); $i++ ){
        //             $CustImages = new CustomerImages();
        //             $CustImages->customer_id = $CustomerID;
        //             $CustImages->company_id = session("CompanyLinkID");
        //             $CustImages->type = "driving_license";

        //             $path = $request->file('driving_license')[$i]->store('CustomersImages');
        //             $CustImages->link = $path;
        //             $CustImages->save();
        //         }
        //     }

        //     if($request->file('visa_detail') && sizeof($request->file('visa_detail')) > 0){
        //         for($i = 0; $i < sizeof($request->file('visa_detail')); $i++ ){
        //             $CustImages = new CustomerImages();
        //             $CustImages->customer_id = $CustomerID;
        //             $CustImages->company_id = session("CompanyLinkID");
        //             $CustImages->type = "visa_detail";

        //             $path = $request->file('visa_detail')[$i]->store('CustomersImages');
        //             $CustImages->link = $path;
        //             $CustImages->save();
        //         }
        //     }
        // }  else {
        //     Log::debug("booking for invite id - ".$Input["invite_id"]);
        // }

        if($Input["additional_kilometers_amount"] <= 0){
            return json_encode(array("Status" =>  0, "Message" => "Additional KM Amount Must Be > 0"));
        }
        
        date_default_timezone_set("Asia/Muscat"); # setting current time zone
        if($Input["PickupDate"]." ".$Input["PickupTime"] < date("Y-m-d H:i:s")){
            return json_encode(array("Status" =>  0, "Message" => "Pickup Date Can't Be in Past"));
        }

        // if($Input["dob"]." ".$Input["dob"] > date('Y-m-d', strtotime('-18 year'))){
        //     return json_encode(array("Status" =>  0, "Message" => "Date Of Birth Can't Be Less Than 18 Years"));
        // }  //TODO fixme

        $BookingObj = new Booking();
        $BookingObj->staff_id = session("AdminID");
        $BookingObj->company_id = session("CompanyLinkID");
        $BookingObj->customer_id = $CustomerID;
        $BookingObj->car_type = $Input["vehicle_id"];
        $BookingObj->tarrif_detail = $Input["tarrif_detail"];
        // $BookingObj->tarrif_type = $Input["tarrif_type"];
        $BookingObj->discount_amount = $Input["discount_amount"];

        $Day = $Input["tarrif_detail"];
        $DopDate = date("Y-m-d", strtotime("+".$Day." days", strtotime($Input["PickupDate"]))). " 00:00:00";
        
        $BookingObj->dropoff_date = $DopDate;
        $BookingObj->additional_info = $Input["additional_info"];
        $BookingObj->tax_percentage = 5;
        $BookingObj->km_allocation = $Input["km_allocation"];
        $BookingObj->pickup_date_time = $Input["PickupDate"]." ".$Input["PickupTime"];
        $BookingObj->pickup_location = $Input["pickup_location"];
        $BookingObj->payment_mode = $Input["payment_mode"];
        $BookingObj->status = 1;
        $BookingObj->additional_kilometers_amount = $Input["additional_kilometers_amount"];
        
        $GetPricing = Pricing::where("car_type", $Input["vehicle_id"])->where("company_id", session("CompanyLinkID"))->first();

        $DailyBasePrice = $WeeklyBasePrice = $MonthlyBasePrice = 0;
        if(isset($GetPricing->daily_pricing)){
            $DailyBasePrice = $GetPricing->daily_pricing;
        }
        if(isset($GetPricing->weekly_pricing)){
            $WeeklyBasePrice = $GetPricing->weekly_pricing;
        }

        if(isset($GetPricing->monthly_pricing)){
            $MonthlyBasePrice = $GetPricing->monthly_pricing;
        }

        if(($DailyBasePrice == 0) && ($WeeklyBasePrice == 0) && ($MonthlyBasePrice == 0) ){
            return json_encode(array("Status" =>  0, "Message" => "Base Price Can't Be 0, Please Set It In Price Manager"));
        }

        //$Amount = $BasePrice * $Input["tarrif_detail"];
        $Amount = $this->rent_calculation($Day, $GetPricing);
        $Total = $Amount;
        $Amount -= $Input["discount_amount"];
        
        $TaxAmount = ($Amount * 5) / 100;
        $SubTotal = $Amount;

        if($SubTotal < 0){
            return json_encode(array("Status" =>  0, "Message" => "Sub Total Amount Can't Be < 0 "));
        }

        $Amount += $TaxAmount;
        
        $BookingObj->sub_total = $SubTotal;
        $BookingObj->grand_total = $Amount;
        $BookingObj->total = $Total;
        //$BookingObj->tarrif_amount = $BasePrice;
        Log::debug("Total : ".$Total); 
        Log::debug("discount_amount : ".$Input["discount_amount"]);
        Log::debug("SubTotal : ".$SubTotal); 
        Log::debug("grand_total : ".$Amount); 
        $BookingObj->save();

        $InviteId = $Input["invite_id"];
        if($InviteId != 0){ 
            //lets not delete but update invite obj.. 
            //BookingInvite::where('id',$InviteId)->delete();
            BookingInvite::where('id',$InviteId)->update(['status' => 2, 'link' => "", 'booking_id' => $BookingObj->id ]);
        }

        $BookingObj = Booking::find($BookingObj->id);
        $data = array("Booking" => $BookingObj);
        try {
            Mail::send("EmailTemplates.Booking", $data, function ($m) use($BookingObj){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($BookingObj->customer->email)->subject("New Car Booking");
            });
        } catch (Exception $e) {
            //echo $e->getMessage();
            //ignore
        }
        // $CheckInvite = BookingInvite::where("email", $Input["email"])->count();
        // if($CheckInvite > 0){
        //     BookingInvite::where("email", $Input["email"])->delete();
        // }

        return json_encode(array("Status" =>  1, "Message" => "Booking Recorded Successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::debug("bookingcontroller show - enter");
        // echo 'sdfjkdsl';die();

        $Booking = Booking::find($id);
        $Booking_pickupdate = substr($Booking->pickup_date_time,0,10)." 00:00:00";
        $Booking_dropoffdate = substr($Booking->dropoff_date,0,10)." 23:59:59";
        Log::info($Booking_pickupdate);
        Log::info($Booking_dropoffdate);
        //$BookedVehicle = Booking::select("vehicle_id")->where("company_id", $Booking->company_id)->where("status","==",2)->where("pickup_date_time", "<=", $Booking_pickupdate)->get()->toArray();
        // $query = 'select vehicle_id from bookings where company_id = '.$Booking->company_id
        // .' and status = 2 and pickup_date_time <= \''.$Booking_pickupdate.'\'';
            
        //Log::info($query);
        //$BookedVehicle = DB::select($query);
        $BookedVehicle = Booking::select("vehicle_id")
                    ->where("company_id", $Booking->company_id)
                    ->where("status",2)
                    ->where("pickup_date_time","<=",$Booking_dropoffdate)
                    ->where("dropoff_date",">=",$Booking_pickupdate)
                    ->get();
        $BookedVehiclesId = array();
        foreach ( $BookedVehicle as $obj ){
            $BookedVehiclesId[] = $obj->vehicle_id;
        }

        Log::info(sizeOf($BookedVehiclesId));
        Log::info(json_encode($BookedVehiclesId));
        //$BookedVehicle = array_filter($BookedVehicle);
        $AllVehicles = Vehicle::whereNotIn("id", $BookedVehiclesId)->where("car_type", $Booking->car_type)->where("company_id", $Booking->company_id)->get();
        $ActiveAction = "booking";

        $CustomerImages = CustomerImages::select("type","link")->where('customer_id',$Booking->customer_id)->get();
        $CustImagesArr = [];
        foreach ($CustomerImages as $imageRow) {
            $type = $imageRow->type;
            if(!isset($CustImagesArr[$type])){
                $CustImagesArr[$type] = []; 
            }
            array_push($CustImagesArr[$type], $imageRow->link);
        }
        Log::debug($CustImagesArr);

        $BookingImages = BookingImages::select("type","link")->where('booking_id',$Booking->id)->get();
        $BookingImagesArr = [];
        foreach ($BookingImages as $imageRow) {
            $type = $imageRow->type;
            if(!isset($BookingImagesArr[$type])){
                $BookingImagesArr[$type] = []; 
            }
            array_push($BookingImagesArr[$type], $imageRow->link);
        }
        Log::debug($BookingImagesArr);

        Log::debug("bookingcontroller show - exit");

        return view('booking.show', compact("Booking", "ActiveAction", "AllVehicles", "CustImagesArr", "BookingImagesArr"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::debug("bookingcontroller edit - enter");

        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Booking = Booking::find($id);
        Log::debug($Booking);
        $CustomerImages = CustomerImages::select("type","link")->where('customer_id',$Booking->customer_id)->get();
        $CustImagesArr = [];
        foreach ($CustomerImages as $imageRow) {
            $type = $imageRow->type;
            if(!isset($CustImagesArr[$type])){
                $CustImagesArr[$type] = []; 
            }
            array_push($CustImagesArr[$type], $imageRow->link);
        }
        // Log::debug($CustImagesArr);

        $BookingImages = BookingImages::select("type","link")->where('booking_id',$Booking->id)->get();
        $BookingImagesArr = [];
        foreach ($BookingImages as $imageRow) {
            $type = $imageRow->type;
            if(!isset($BookingImagesArr[$type])){
                $BookingImagesArr[$type] = []; 
            }
            array_push($BookingImagesArr[$type], $imageRow->link);
        }
        // Log::debug($BookingImagesArr);

        $ActiveAction = "booking";
        Log::debug("bookingcontroller edit - exit");
        return view('booking.edit', compact("Booking", "CustImagesArr", "BookingImagesArr", "ActiveAction"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::debug("bookingcontroller update - enter");

        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Booking = Booking::find($id);

        $Input = $request->all();
        
        if(isset($Input["km_drop_time"])){
            Log::debug("if discount_amount :".$Input["discount_amount"]);
            if($Input["km_drop_time"] < $Booking->km_reading_pickup){
                Session::flash('Danger', "Dropp of KM is less then KM at Pickup");
                return redirect()->back()->withInput();
            }
            
            $ExtraAmount = 0;
            
            $ExtraKM = $Input["km_drop_time"] - $Booking->km_reading_pickup;
            $AllowedKM = $Booking->km_allocation * $Booking->tarrif_detail;
            $Extra = $ExtraKM - $AllowedKM;
            if($Extra < 0){
                $Extra = 0;
            }
            
            $ExtraAmount = ($Booking->additional_kilometers_amount * $Extra);
            Log::debug("ExtraAmount :".$ExtraAmount);
            $ExtraAmount = $ExtraAmount + trim($Input["additional_charges"]);
            Log::debug("ExtraAmount with additional_charges :".$ExtraAmount);
            
            Log::debug("Total --:".$Booking->total);

            Log::debug("SubTotal -- :".$Booking->sub_total);
            
            #$Amount = $Booking->sub_total + $ExtraAmount + $Input["additional_charges"];
             $SubTotal = $Booking->total  - $Input["discount_amount"] + $ExtraAmount;
            // $Amount = $SubTotal  + $ExtraAmount
            //$Amount = $Booking->sub_total + $ExtraAmount ;
            #$Amount -= $Input["discount_amount"];
            $Amount = $SubTotal;
            $TaxAmount = ($Amount * 5) / 100;
            //$SubTotal = $Amount;
            $Amount += $TaxAmount;

            Log::debug("SubTotal :".$SubTotal);
            Log::debug("grand_total :".$Amount);
            Log::debug("discount_amount :".$Input["discount_amount"]);

            $Input["sub_total"] = $SubTotal;
            $Input["grand_total"] = $Amount;
            $Input["additional_km_reunning"] = $Extra;
            $Input["dropoff_date"] = date("Y-m-d H:i:s");
        } else{
            if(isset($Input["discount_amount"])){
                // $Total = $Booking->total ;
                $SubTotal = $Booking->total - $Input["discount_amount"];
                $TaxAmount = ($SubTotal * 5) / 100;
                $Amount = $SubTotal + $TaxAmount;

                Log::debug("SubTotal1 :".$SubTotal);
                Log::debug("grand_total1 :".$Amount);
                Log::debug("discount_amount1 :".$Input["discount_amount"]);

                $Input["sub_total"] = $SubTotal;
                $Input["grand_total"] = $Amount;
            }
        }

        unset($Input["_method"]);
        unset($Input["_token"]);
        
        // if($request->file('damge_image') != null){
        //     $path = $request->file('damge_image')->store('BookimngImages');
        //     $Input['damge_image'] = $path;
        // }        
        
        if(isset($Input["final_amount_paid"])){
            $Input["status"] = 3;
            $Input["final_amount_paid"] = doubleval(str_replace(',','',$Input["final_amount_paid"]));
        }
        
        
        // if($request->file('car_image') != null){
        //     $path = $request->file('car_image')->store('BookimngImages');
        //     $Input['car_image'] = $path;
        // }
        
        if(isset($Input["km_reading_pickup"])){
            $Input["status"] = 2;
        }
        
        Booking::where('id', $id)->update($Input);
        $Booking = Booking::find($id);
        
        //upload car image files..
        if($request->file('car_image') && sizeof($request->file('car_image')) > 0){
            for($i = 0; $i < sizeof($request->file('car_image')); $i++ ){
                $BookingImages = new BookingImages();
                $BookingImages->booking_id = $Booking->id;
                $BookingImages->company_id = session("CompanyLinkID");
                $BookingImages->vehicle_id = $Booking->vehicle_id;
                $BookingImages->type = "car_image";

                $path = $request->file('car_image')[$i]->store('BookimngImages');
                Log::debug($path);
                $BookingImages->link = $path;
                $BookingImages->save();
            }
        }

        //upload car damge  files..
        if($request->file('damge_image') && sizeof($request->file('damge_image')) > 0){
            for($i = 0; $i < sizeof($request->file('damge_image')); $i++ ){
                $BookingImages = new BookingImages();
                $BookingImages->booking_id = $Booking->id;
                $BookingImages->company_id = session("CompanyLinkID");
                $BookingImages->vehicle_id = $Booking->vehicle_id;
                $BookingImages->type = "damge_image";

                $path = $request->file('damge_image')[$i]->store('BookimngImages');
                Log::debug($path);
                $BookingImages->link = $path;
                $BookingImages->save();
            }
        }
                        
        if(isset($Input["final_amount_paid"])){
            $data = array("Booking" => $Booking);
            Mail::send("EmailTemplates.BookingComplete", $data, function ($m) use($Booking){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($Booking->customer->email)->subject("New Car Booking");
            });
            
            if($Booking->discount_amount > 0){
            $data = array("Booking" => $Booking);
                Mail::send("EmailTemplates.BookingComplete", $data, function ($m) use($Booking){
                    $m->from("no-reply@nucleuz.app", "Nucleuz");
                    $m->to("info@nucleuz.app")->subject("Added Discount for this Booking");
                });
            }
        }

        if(isset($Input["km_reading_pickup"])){
            $data = array("Booking" => $Booking);
            Log::debug("bookingcontroller update - sending email");
            Mail::send("EmailTemplates.Booking2", $data, function ($m) use($Booking){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($Booking->customer->email)->subject("New Car Booking");
            });
        }

        Log::debug("bookingcontroller update - exit");

        return redirect("booking/".$id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        Booking::find($id)->delete();
        return redirect("booking");
    }

    public function BookingExceed(Request $request, $id){
        Log::debug("bookingcontroller exceed - enter");
        $Input = $request->all();

        if(isset($Input["drop_off_confirm"])){
            date_default_timezone_set("Asia/Muscat"); # setting current time zone
            $DayDiff = $this->time_difference (date("Y-m-d"), $Input["dropoff_date"],"day");
            if($DayDiff != 0){
               Session::flash('Danger', "To Droff Off Vehicle, Droff Off Date Should Be Current Date.");
               return redirect()->back()->withInput();
           }
        }

        $vehicle = Booking::select("vehicle_id","car_type")->where("company_id", session("CompanyLinkID"))->where("id",$id)->first();
        $GetPricing = Pricing::where("car_type", $vehicle["car_type"])->where("company_id", session("CompanyLinkID"))->first();

        unset($Input["_method"]);
        unset($Input["_token"]);
        
        $GetBooking = Booking::find($id);

       // $Input["dropoff_date"] = $Input["dropoff_date"]." ".$Input["dropoff_time"];
        $ExtraDay = $this->time_difference ($GetBooking->dropoff_date, $Input["dropoff_date"], "day");
        Log::debug("ExtraDay : ".$ExtraDay);

        $GetBooking->tarrif_detail += (int)$ExtraDay;
        $Input["tarrif_detail"] = $GetBooking->tarrif_detail;

        Log::debug("Input : ".$Input["tarrif_detail"]);

        $ExtraAmount = $this->extraDays_calculation($ExtraDay, $GetPricing);
        
        Log::debug("Total :".$GetBooking->total);
        $GetBooking->total = $GetBooking->total + $ExtraAmount;
        Log::debug("Total with extra:".$GetBooking->total);
        #$ExtraAmount = (float)$ExtraDay * $GetBooking->tarrif_amount;
        Log::debug("ExtraAmount :".$ExtraAmount);
        $SubTotal = $GetBooking->sub_total + $ExtraAmount;
        $TaxAmount = 0;
        if($SubTotal > 0 ){
            $TaxAmount = ($SubTotal * 5) / 100;
        }
        #$GrandTotal = $GetBooking->grand_total + $ExtraAmount;
        $GrandTotal = $SubTotal + $TaxAmount;
        
        $Input["sub_total"] = $SubTotal;
        $Input["grand_total"] = $GrandTotal;

        Log::debug("SubTotal :".$SubTotal);
        Log::debug("GrandTotal :".$GrandTotal);
        
        unset($Input["dropoff_time"]);
        $GetBooking->save();
        Log::debug("Total after save:".$GetBooking->total);
        Booking::where('id', $id)->update($Input);
        return redirect("booking/".$id."/edit");
    }
    
    function time_difference($time_1, $time_2, $limit = null){
        $val_1 = new \DateTime($time_1);
        $val_2 = new \DateTime($time_2);
        Log::debug("val_1  ".$time_1);
        Log::debug("val_2 ".$time_2);

        $days = $val_1->diff($val_2)->format('%r%a');
        Log::debug("days ".$days);
        return $days;
        }


    public function review(Request $request){
        Log::debug("bookingcontroller review - enter");

        try{
            $Input = $request->all();
            $GetPricing = Pricing::where("company_id", session("CompanyLinkID"))->where("car_type", $Input["vehicle"])->first();

            $DailyBasePrice = $WeeklyBasePrice = $MonthlyBasePrice = 0;
            if(isset($GetPricing->daily_pricing)){
                $DailyBasePrice = $GetPricing->daily_pricing;
            }

            if(isset($GetPricing->weekly_pricing)){
                $WeeklyBasePrice = $GetPricing->weekly_pricing;
            }
            if(isset($GetPricing->monthly_pricing)){
                $MonthlyBasePrice = $GetPricing->monthly_pricing;
            }

            if(($DailyBasePrice == 0) && ($WeeklyBasePrice == 0) && ($MonthlyBasePrice == 0) ){
                return json_encode(array("GrandTotal" => 0, "Tax" => 0, "SubTotal" => 0, "Discount" => 0, "Due" => 0, "Advance" => 0));
            }

            $Amount = $this->rent_calculation($Input["days"], $GetPricing);

            Log::debug("Total : ".$Amount);
            Log::debug("discount : ".$Input["discount"]);
            
            $DiscountAmount = number_format($Input["discount"], 2);
            $Amount -= $Input["discount"];
            
            $TaxAmount = 0;
            if($Amount > 0){
                $TaxAmount = ($Amount * $Input["tax"]) / 100;
            }

            $SubTotal = number_format($Amount, 2);
            $Amount += $TaxAmount;
            

            $TaxAmount = number_format($TaxAmount, 2);

            $AdvanceAmount = 0;
            $DueAmount = 0;

            $DueAmount = $Amount;
            $Amount = number_format($Amount, 2);

            Log::debug("SubTotal : ".$SubTotal);
            Log::debug("GrandTotal : ".$Amount);

            Log::debug("bookingcontroller review - exit");

            return json_encode(array("GrandTotal" => $Amount, "Tax" => $TaxAmount, "SubTotal" => $SubTotal, "Discount" => $DiscountAmount, "Due" => number_format($DueAmount, 2), "Advance" => $AdvanceAmount));
        }catch(Exception $e){
            echo $e->getMessage();
        }

        
    }

    public function GetAvailableCarTypes(Request $request){
        try {
            $GetAllVehicles = DB::table('vehicles')
                        ->selectRaw('car_type, count(*) as count')
                        ->where("company_id",session("CompanyLinkID"))
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get()
                        ;

            $numOfDays = $request->numOfDays;
            $pickupDateTime = $request->pickupDate." 00:00:00";
            $dropDateTime = date('Y-m-d 23:59:59', strtotime("$pickupDateTime +$numOfDays days"));
            Log::info($dropDateTime);

            $getAllVehicleResp = collect();
            foreach ( $GetAllVehicles as $obj ){
                $getAllVehicleResp[$obj->car_type] = $obj->count;
            }

            $query = 'select car_type from bookings where company_id = '.session("CompanyLinkID")
                    .' and ((status = 1 and pickup_date_time <= \''.$dropDateTime.'\' and dropoff_date >= \''.$pickupDateTime.'\') or ' 
                    .' ( status = 2 and pickup_date_time <= \''.$dropDateTime.'\' ))';
                    
                        
            //Log::info($query);
            $GetAllBookings = DB::select($query);
            foreach ($GetAllBookings as $obj){
                $getAllVehicleResp[$obj->car_type] -= 1;
            }

            return json_encode($getAllVehicleResp);
        } catch(Exception $e){
            echo $e.getMessage();
        }
    }

    public function CancelBooking($id){
        $Booking = Booking::find($id);
        $Booking->status = 4;
        $Booking->grand_total = 0;
        $Booking->save();
        return redirect("booking");
    }

    public function AssignVehicle(Request $request){ //TODO add implementation
        $Booking = Booking::find($request->id);

        $data = array();
        return json_encode(array("status" => 1, "Message" => "", "Data" => $data));
    }

    public function exportPdf($id){ //TODO add implementation
        $booking = Booking::find($id);
        
        $pdf = Pdf::loadView('booking.view_pdf', compact('booking'));
        return $pdf->download('booking_'.$id.'.pdf');
    }

    public function ReviewCustomer(Request $request){
        try{
            Log::debug("bookingcontroller ReviewCustomer - enter");
            $Input = $request->all();
            $GetPricing = Pricing::where("company_id", $Input["company"])->where("car_type", $Input["vehicle"])->first();

            $DailyPrice = $WeeklyPrice = $MonthlyPrice = 0;
            if(isset($GetPricing->daily_pricing)){
                $DailyPrice = $GetPricing->daily_pricing;
            }

            if(isset($GetPricing->weekly_pricing)){
                $WeeklyPrice = $GetPricing->weekly_pricing;
            }

            if(isset($GetPricing->monthly_pricing)){
                $MonthlyPrice = $GetPricing->monthly_pricing;
            }

           // $Amount = $BasePrice * $Input["days"];
            $Amount = $this->rent_calculation($Input["days"], $GetPricing);
            $TaxAmount = ($Amount * $Input["tax"]) / 100;
            $SubTotal = number_format($Amount, 2);
            $DiscountAmount = 0;
            $Amount += $TaxAmount;
            $TaxAmount = number_format($TaxAmount, 2);

            $AdvanceAmount = 0;
            $DueAmount = number_format($Amount, 2);
            $Amount = number_format($Amount, 2);
            Log::debug("bookingcontroller ReviewCustomer - exit");
            return json_encode(array("GrandTotal" => $Amount, "Tax" => $TaxAmount, "SubTotal" => $SubTotal, "Discount" => $DiscountAmount, "Due" => number_format($DueAmount, 2), "Advance" => $AdvanceAmount));
        }catch(\Exception $e){

        }
    }
    
    function rent_calculation($Day, $GetPricing){
        $Amount = 0;
        $DailyBasePrice = $WeeklyBasePrice = $MonthlyBasePrice = 0;
        #$Day = $Input["days"];
        //$CalculationMethod = "Hybrid";
        $CalculationMethod = Office::find(session("CompanyLinkID"))->billing_method;

        if(isset($GetPricing->daily_pricing)){
            $DailyBasePrice = $GetPricing->daily_pricing;
        }

        if(isset($GetPricing->weekly_pricing)){
                $WeeklyBasePrice = $GetPricing->weekly_pricing;
        }

        if(isset($GetPricing->monthly_pricing)){
            $MonthlyBasePrice = $GetPricing->monthly_pricing;
        }

        switch($CalculationMethod){
            //case "Fixed" :
              //  Log::debug("Your favorite CalculationMethod is Fixed!");
               // $Amount =  $DailyBasePrice * $Day;
               // break;
            case "Hybrid" :
                Log::debug("Your favorite CalculationMethod is Hybrid!");
                $Month = floor((int)$Day/30);
                $Week = floor(((int)$Day - (int)$Month * 30)/7);
                $Days = (int)$Day - (int)$Month * 30 - (int)$Week * 7;
                
                if(isset($GetPricing->monthly_pricing)){
                    $Amount += (float)$Month * $GetPricing->monthly_pricing;
                }
                if(isset($GetPricing->weekly_pricing)){
                    $Amount += (float)$Week * $GetPricing->weekly_pricing;
                }
                if(isset($GetPricing->daily_pricing)){
                    $Amount += (float)$Days * $GetPricing->daily_pricing;
                }
                break; 
            case "Pro-Rata" :
                Log::debug("Your favorite CalculationMethod is Pro-Rata!");
                if($Day > 29){
                    $Month = floor((int)$Day/30);
                    $Amount += (float)$Month * $MonthlyBasePrice;
                    $RemainingDays = (int)$Day - (int)$Month * 30 ;
                    $Amount += (float)($MonthlyBasePrice * $RemainingDays)/30;
                }elseif($Day > 6){
                    $Week = floor(((int)$Day)/7);
                    $Amount += (float)$Week * $WeeklyBasePrice;
                    $RemainingDays = (int)$Day - (int)$Week * 7 ;
                    $Amount += (float)($WeeklyBasePrice * $RemainingDays)/7;
                }else{
                    $Amount = (float)$Day * $DailyBasePrice;
                }
                break;  
            default :
                Log::debug("Your favorite CalculationMethod is Fixed!");
                $Amount =  $DailyBasePrice * $Day;
        }
        return $Amount;
    }

    function extraDays_calculation($Day, $GetPricing){
        $Amount = 0;
        //$Day = $ExtraDay;
        $Month = $Week = $Days =0;
        $IsNegative = false;
        //$CalculationMethod = "Hybrid";
        $CalculationMethod = Office::find(session("CompanyLinkID"))->billing_method;

        if(isset($GetPricing->monthly_pricing)){
            $MonthlyBasePrice = $GetPricing->monthly_pricing;
        }
        if(isset($GetPricing->weekly_pricing)){
            $WeeklyBasePrice = $GetPricing->weekly_pricing;
        }
        if(isset($GetPricing->daily_pricing)){
            $DailyBasePrice = $GetPricing->daily_pricing;
        }

        switch($CalculationMethod){
            //case "Fixed" :
              //  Log::debug("Your favorite CalculationMethod is Fixed!");
                //$Amount =  $DailyBasePrice * $Day;
                //break;
            case "Hybrid" :
                Log::debug("Your favorite CalculationMethod is Hybrid!");
                if($Day > 0){
                    $Month = floor((int)$Day/30);
                    $Week = floor(((int)$Day - (int)$Month * 30)/7);
                    $Days = (int)$Day - (int)$Month * 30 - (int)$Week * 7;
                }elseif($Day < 0 ){
                    $DaysInPositive = -$Day;
                    $Month = floor((int)$DaysInPositive/30);
                    $Week = floor(((int)$DaysInPositive - (int)$Month * 30)/7);
                    $Days = (int)$DaysInPositive - (int)$Month * 30 - (int)$Week * 7;

                    $Month = -$Month;
                    $Week = -$Week;
                    $Days = -$Days;
                }else{
                    $Month = $Week = $Days =0;
                }
            
                if(isset($GetPricing->monthly_pricing)){
                    $Amount += (float)$Month * $GetPricing->monthly_pricing;
                }
                if(isset($GetPricing->weekly_pricing)){
                    $Amount += (float)$Week * $GetPricing->weekly_pricing;
                }
                if(isset($GetPricing->daily_pricing)){
                    $Amount += (float)$Days * $GetPricing->daily_pricing;
                }
                break; 
            case "Pro-Rata" :
                Log::debug("Your favorite CalculationMethod is Prodata!");
                if($Day < 0){
                    $IsNegative = true;
                    $Day = -$Day;
                }
                if($Day > 29){
                    $Month = floor((int)$Day/30);
                    $RemainingDays = (int)$Day - (int)$Month * 30 ;

                    if($IsNegative){
                        $Month = -$Month ;
                        $RemainingDays = -$RemainingDays;
                        $Amount += (float)$Month * $MonthlyBasePrice;
                        $Amount += (float)($MonthlyBasePrice * $RemainingDays)/30;
                    }else{
                        $Amount += (float)$Month * $MonthlyBasePrice;
                        $Amount += (float)($MonthlyBasePrice * $RemainingDays)/30;
                    }
                }elseif($Day > 6){
                    $Week = floor(((int)$Day)/7);
                    $RemainingDays = (int)$Day - (int)$Week * 7 ;

                    if($IsNegative){
                        $Week  = -$Week ;
                        $RemainingDays = - $RemainingDays;  
                        $Amount += (float)$Week * $WeeklyBasePrice;
                        $Amount += (float)($WeeklyBasePrice * $RemainingDays)/7;
                    }else{
                        $Amount += (float)$Week * $WeeklyBasePrice;
                        $Amount += (float)($WeeklyBasePrice * $RemainingDays)/7;
                    }
                }else{
                    if($IsNegative){
                        $Day = -$Day;
                    }
                    $Amount = (float)$Day * $DailyBasePrice;
                }
                break;  
            default :
                Log::debug("Your favorite CalculationMethod is Fixed!");
                $Amount =  $DailyBasePrice * $Day;
        }
        return $Amount;
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
