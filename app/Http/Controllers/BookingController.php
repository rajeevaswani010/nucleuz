<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Session;
use Mail;
use Excel;
use DateTime;

use App\Export\BookingExport;
use App\Models\Vehicle;
use App\Models\Pricing;
use App\Models\Country;
use App\Models\Booking;
use App\Models\BookingVehicle;
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
        $CustomerId = 0;
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
        } else if (array_key_exists("customerId",$Input)){
            $CustomerId = $Input["customerId"];
        }

        $ActiveAction = "booking";
        // $AllVehicles = Vehicle::where("company_id", session("CompanyLinkID"))->get();
        // $AllPricing = Pricing::where("company_id", session("CompanyLinkID"))->get();
        $Conuntry = Country::orderBy("name")->get();
        return view('booking.add', compact("ActiveAction", "Conuntry", "Requirements", "CustomerId", "InviteId"));
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
        Log::debug("bookingcontroller store - enter");
        
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

        Log::debug("DopDate : ".$DopDate); 
        
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
        
        $BookingObj->total = $Total;  // this is rent
        $BookingObj->sub_total = $SubTotal; // this is total-discount
        $BookingObj->grand_total = $Amount; //this is subtotal+tax
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
        Log::debug("bookingcontroller store - exit");
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
        $BookingVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))->where("booking_id",$id)->orderBy('created_at', 'desc')->get();
        Log::debug($BookingVehicle);
        $CurrentVehicle = null;
        if($Booking->cur_booking_vehicle_id != null){
            $CurrentVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))->where("booking_id",$id)->where("id",$Booking->cur_booking_vehicle_id)->first();
            // $CurrentVehicle = Vehicle::where("company_id",session("CompanyLinkID"))->where("id",$CurrentVehicleId->vehicle_id)->get();
            Log::debug("current vehicle - ");
            Log::debug($CurrentVehicle);
        }

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
        return view('booking.edit', compact("Booking", "BookingVehicle", "CurrentVehicle", "CustImagesArr", "BookingImagesArr", "ActiveAction"));
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
        Log::debug($Input);

        $BookingVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))->where("booking_id",$id)->orderBy('created_at', 'desc')->get();

        $vehicle = Booking::select("vehicle_id","car_type")->where("company_id", session("CompanyLinkID"))->where("id",$id)->first();
        $GetPricing = Pricing::where("car_type", $vehicle["car_type"])->where("company_id", session("CompanyLinkID"))->first();

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
                date_default_timezone_set("Asia/Muscat"); # setting current time zone
                $DayDiff = $this->time_difference (date("Y-m-d"), $Booking->pickup_date_time,"day");
                if($DayDiff != 0){
                   $ExtraAmount = $this->extraDays_calculation($DayDiff, $GetPricing);
                   $Booking->pickup_date_time = date("Y-m-d H:i:s");
                   $Booking->tarrif_detail += (int)$DayDiff;
                   $Booking->total +=  $ExtraAmount;
                }else{
                   $Booking->pickup_date_time = date("Y-m-d H:i:s");
                }
                $Booking->save();
                $Booking = Booking::find($id);
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

            $Vehicle = Vehicle::where("company_id",session("CompanyLinkID"))->where('id',$Input['vehicle_id'])->first();
            Log::debug($Vehicle);

            $BookingVehicle = new BookingVehicle();
            $BookingVehicle->company_id = $Booking->company_id;
            $BookingVehicle->booking_id = $Booking->id;
            $BookingVehicle->vehicle_id = $Input['vehicle_id'];
            $BookingVehicle->car_type = $Vehicle->car_type;
            $BookingVehicle->make = $Vehicle->make;
            $BookingVehicle->model = $Vehicle->model;
            $BookingVehicle->variant = $Vehicle->variant;
            $BookingVehicle->reg_no = $Vehicle->reg_no;
            $BookingVehicle->pickup_date_time = date('Y-m-d H:i:s');
            $BookingVehicle->km_reading_pickup = $Input["km_reading_pickup"];

            $BookingVehicle->save();
        }
        
        if(isset($Input["km_drop_time"])){
            $Input["status"] = 5;
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
               Session::flash('Danger', "To Droff Off Vehicle, Droff Off Date Should Be Todays Date.");
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
        Log::debug("val_1 ".$time_1);
        Log::debug("val_2 ".$time_2);

        $days = $val_1->diff($val_2)->format('%r%a');
        Log::debug("days ".$days);
        return $days;
        }


    public function review(Request $request){
        Log::debug("bookingcontroller review - enter");
        Log::debug(sprintf("%s - line %d - review", __FILE__, __LINE__));

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
    
    public function GetAvailableVehicles(Request $request){
        Log::debug("bookingcontroller GetAvailableVehicles - enter");
        try {
            $Input = $request->all();
            Log::debug($Input);

            $Booking = Booking::find($Input["booking_id"]);
            $Booking_pickupdate = substr($Booking->pickup_date_time,0,10)." 00:00:00";
            $Booking_dropoffdate = substr($Booking->dropoff_date,0,10)." 23:59:59";
    
            // $BookedVehicle = Booking::select("vehicle_id")
            //     ->where("company_id", $Booking->company_id)
            //     ->where("status",2)
            //     ->where("pickup_date_time","<=",$Booking_dropoffdate)
            //     ->where("dropoff_date",">=",$Booking_pickupdate)
            //     ->get();
            $query = 'select booking_vehicles.vehicle_id from booking_vehicles 
                    INNER JOIN bookings on bookings.cur_booking_vehicle_id = booking_vehicles.id 
                    where bookings.company_id = '.session("CompanyLinkID")
                    .' and bookings.status = 2 and bookings.pickup_date_time <= \''.$Booking_dropoffdate.'\''
                    .' and bookings.dropoff_date >= \''.$Booking_pickupdate.'\''
                ;

            Log::info($query);
            $BookedVehicles = DB::select($query);
            $BookedVehiclesId = array();
            foreach ( $BookedVehicles as $obj ){
                $BookedVehiclesId[] = $obj->vehicle_id;
            }

            Log::debug($BookedVehiclesId);

            if($Input["car_type"] != ""){
                $AllVehicles = Vehicle::whereNotIn("id", $BookedVehiclesId)->where("car_type", $Input["car_type"])->where("company_id", $Booking->company_id)->where("status",1)->get();
            } else {
                $AllVehicles = Vehicle::whereNotIn("id", $BookedVehiclesId)->where("company_id", $Booking->company_id)->where("status",1)->get();
            }

            return json_encode(array("Status" => 1 , "Message" => "" , "Data" => $AllVehicles));
        } catch(Exception $e){
            echo $e.getMessage();
            return json_encode(array("Status" => 0 , "Message" => "Fail to get vehicles." , "Data" => array()));
        }
    }


    public function GetAvailableCarTypes(Request $request){
        try {
            $Input = $request->all();
            Log::debug($Input);

            $dropDateTime;
            $booking_id = null;
            $pickupDateTime = $Input["pickupDate"]." 00:00:00";
            if (isset($Input['booking_id'])) {
                $booking_id = $Input['booking_id']; //counter the current booking for checking vehicle availability
            }
            
            if (isset($Input['numOfDays'])) {
                $numOfDays = $request->numOfDays;
                $dropDateTime = date('Y-m-d 23:59:59', strtotime("$pickupDateTime +$numOfDays days"));
            } else {
                $dropDateTime = $Input["dropoffDate"];
            }
            Log::info($dropDateTime);

            $data = $this->_getAvailableCarTypes($pickupDateTime,$dropDateTime,$booking_id);
            return json_encode(array("Status" => 1, "Message" => "", "Data" => $data));
        } catch(Exception $e){
            echo $e.getMessage();
            return json_encode(array("Status" => 0 , "Message" => "Fail to get available vehicles types." , "Data" => array()));
        }
    }

    public function CancelBooking($id){
        $Booking = Booking::find($id);
        $Booking->status = 4;
        $Booking->grand_total = 0;
        $Booking->save();
        return redirect("booking");
    }

    public function CloseBooking($id){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        Log::debug($id);
        $Booking = Booking::find($id);

        Log::debug("close booking");
        $Booking->dropoff_date = date('Y-m-d H:i:s'); // change to time recieved from browser

        //update billing details
        $total = $Booking->total;
        $subTotal = $total - $Booking->discount_amount;

        $TotalKm = 0;
        $BookingVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))->where("booking_id",$Booking->id)->orderBy('created_at', 'desc')->get();
        foreach ($BookingVehicle as $vehicle) {
            $TotalKm += $vehicle->km_driven;
        }
        Log::debug($TotalKm);
        $AllowedKM = $Booking->km_allocation * $Booking->tarrif_detail;
        $ExtraKM = $TotalKm - $AllowedKM;
        
        if($ExtraKM > 0){
            $Booking->additional_km_reunning = $ExtraKM ;
            $ExtraAmount = ($Booking->additional_kilometers_amount * $ExtraKM);
            $subTotal += $ExtraAmount;   
        } else {
            $Booking->additional_km_reunning = 0;
        }
        
        $Booking->sub_total = $subTotal;
        $TaxAmount = ($subTotal * 5) / 100;
        //update status
        $Booking->drop_off_confirm = 1;
        $this->_updateBillingDetails($Booking);

        $Booking->save();
        return redirect("booking/".$id."/edit");

    }

    public function AssignVehicle(Request $request){ //TODO add implementation
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input);
        $reqCarType = $Input["car_type"];
        $Booking = Booking::find($request->booking_id);
        $Vehicle = Vehicle::find($Input['vehicle_id']);

        $GetPricing = Pricing::where("car_type", $Vehicle["car_type"])->where("company_id", session("CompanyLinkID"))->first();

        // validations
        
        // check license expiry
        $licenseExpiry = new DateTime($Input["license_expiry_date"]);
        $curDate = new DateTime();
        $threeMonthsLater = $curDate->modify('+3 months');
        if ($licenseExpiry < $threeMonthsLater) {
            return json_encode(array("Status" => 0, "Message" => "Booking Error. License expiry date shall be more than 3 months", "Data" => null));
        }

        //check residence card expiry
        $residencyCardExpiry = new DateTime($Input["residence_expiry_date"]);
        if ($residencyCardExpiry < $threeMonthsLater) {
            return json_encode(array("Status" => 0, "Message" => "Booking Error. Residence expiry date shall be more than 3 months", "Data" => null));
        }

        // return json_encode(array("Status" => 0, "Message" => "Doing testing.. ", "Data" => array()));
        date_default_timezone_set("Asia/Muscat"); # setting current time zone

        $BookingVehicle = new BookingVehicle();
        $BookingVehicle->company_id = $Booking->company_id;
        $BookingVehicle->booking_id = $Booking->id;
        $BookingVehicle->vehicle_id = $Input['vehicle_id'];
        $BookingVehicle->car_type = $Vehicle->car_type;
        $BookingVehicle->make = $Vehicle->make;
        $BookingVehicle->model = $Vehicle->model;
        $BookingVehicle->variant = $Vehicle->variant;
        $BookingVehicle->reg_no = $Vehicle->reg_no;
        $BookingVehicle->pickup_date_time = date('Y-m-d H:i:s');
        $BookingVehicle->km_reading_pickup = $Input["km_reading_pickup"];
        $BookingVehicle->save();
        Log::debug($BookingVehicle->id);

        $Booking->cur_booking_vehicle_id = $BookingVehicle->id;
        $Booking->vehicle_id = $BookingVehicle->vehicle_id;
        $Booking->advance_amount = $Input["advance_amount"];
        $Booking->discount_amount = $Input["discount_amount"];
        $Booking->license_expiry_date = $licenseExpiry;
        $Booking->residence_expiry_date = $residencyCardExpiry;
        $Booking->residency_card_id = $Input["residency_card_id"];

        // $Booking->advance_amount = $Input["advance_amount"];

        // #changing Assign Date calculations.
        // date_default_timezone_set("Asia/Muscat"); # setting current time zone
        // $DayDiff = $this->time_difference (date("Y-m-d"), $Booking->pickup_date_time,"day");
        // if($DayDiff != 0){
        //    $ExtraAmount = $this->extraDays_calculation($DayDiff, $GetPricing);
        //    $Booking->pickup_date_time = date("Y-m-d H:i:s");
        //    $Booking->tarrif_detail += (int)$DayDiff;
        //    $Booking->total +=  $ExtraAmount;
        // }else{
        //    $Booking->pickup_date_time = date("Y-m-d H:i:s");
        // }
        // $BookingVehicle->pickup_date_time = $Booking->pickup_date_time;
        // $Booking->save();
        // $BookingVehicle->save();

        // $Booking = Booking::find($request->booking_id);
        // $SubTotal = $Booking->total - $Input["discount_amount"];
        // $TaxAmount = ($SubTotal * 5) / 100;
        // $Amount = $SubTotal + $TaxAmount;

        // $Booking->sub_total = $SubTotal;
        // $Booking->grand_total = $Amount;

        if($Booking->status == 1){
            $Booking->pickup_date_time =  $BookingVehicle->pickup_date_time;
            $this->_updateBillingDetails($Booking);
        }
        
        $Booking->status = 2;


        //update tarrif
        Log::debug("new tariff detail - ".$Booking->tarrif_detail);

        $Booking->save(); //save booking changes

        //upload car image files..
        if($request->file('car_image') && sizeof($request->file('car_image')) > 0){
            for($i = 0; $i < sizeof($request->file('car_image')); $i++ ){
                $BookingImages = new BookingImages();
                $BookingImages->booking_id = $Booking->id;
                $BookingImages->company_id = session("CompanyLinkID");
                // $BookingImages->vehicle_id = $Input["vehicle_id"];
                $BookingImages->booking_vehicle_id = $BookingVehicle->id;
                $BookingImages->type = "car_image";

                $path = $request->file('car_image')[$i]->store('BookimngImages');
                Log::debug($path);
                $BookingImages->link = $path;
                Log::debug("before save image");
                Log::debug($BookingImages);
                $BookingImages->save();
            }
        }

        $data = array("Booking" => $Booking);
        Log::debug("bookingcontroller update - sending email");
        Mail::send("EmailTemplates.Booking2", $data, function ($m) use($Booking){
            $m->from("no-reply@nucleuz.app", "Nucleuz");
            $m->to($Booking->customer->email)->subject("New Car Booking");
        });
        
        $data = array();
        return json_encode(array("Status" => 1, "Message" => "Vehicle successfully assigned", "Data" => $data));
    }

    public function dropOffVehicle(Request $request){ //TODO add implementation
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();

        Log::debug($Input);
        $Booking = Booking::find($request->booking_id);
        $CurrentBookingVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))
                    ->where("id",$Input["cur_vehicle_id"])
                    ->where("booking_id",$Input["booking_id"])
                    ->first()
                ;

        //check residence card expiry
        if ( $Input["km_drop_time"] <= 0 && $Input["km_drop_time"] < $CurrentBookingVehicle->km_reading_pickup ) {
            return json_encode(array("Status" => 0, "Message" => "Booking Error. invalid input", "Data" => null));
        }
        
        date_default_timezone_set("Asia/Muscat"); # setting current time zone

        $CurrentBookingVehicle->km_drop_time = $Input["km_drop_time"];
        $CurrentBookingVehicle->dmage = $Input["dmage"];
        $CurrentBookingVehicle->km_driven = $CurrentBookingVehicle->km_drop_time - $CurrentBookingVehicle->km_reading_pickup;
        $CurrentBookingVehicle->dropoff_date = date('Y-m-d H:i:s'); // change to time recieved from browser
        $CurrentBookingVehicle->save();

        Log::debug($CurrentBookingVehicle);
        
        // upload car damge  files..
        if($request->file('damge_image') && sizeof($request->file('damge_image')) > 0){
            for($i = 0; $i < sizeof($request->file('damge_image')); $i++ ){
                $BookingImages = new BookingImages();
                $BookingImages->booking_id = $Booking->id;
                $BookingImages->company_id = session("CompanyLinkID");
                // $BookingImages->vehicle_id = $CurrentBookingVehicle->vehicle_id;
                $BookingImages->booking_vehicle_id = $CurrentBookingVehicle->id;
                $BookingImages->type = "damge_image";

                $path = $request->file('damge_image')[$i]->store('BookimngImages');
                Log::debug($path);
                $BookingImages->link = $path;
                $BookingImages->save();
            }
        }
        
        $curVehicle = Vehicle::where("company_id",session("CompanyLinkID"))->where("id",$Input["cur_vehicle_id"])->first();
        if($Input["dmage"] == 1){
             $curVehicle->status = 3;
            $curVehicle->save();
        }
        Log::debug($curVehicle);

        if(isset($Input["confirm_dropoff"]) && $Input["confirm_dropoff"] == 1){
            Log::debug("close booking");
            $Booking->dropoff_date = date('Y-m-d H:i:s'); // change to time recieved from browser

            //update billing details
            $total = $Booking->total;
            $subTotal = $total - $Booking->discount_amount;

            $TotalKm = 0;
            $BookingVehicle = BookingVehicle::where("company_id",session("CompanyLinkID"))->where("booking_id",$Booking->id)->orderBy('created_at', 'desc')->get();
            foreach ($BookingVehicle as $vehicle) {
                $TotalKm += $vehicle->km_driven;
            }
            Log::debug($TotalKm);
            $AllowedKM = $Booking->km_allocation * $Booking->tarrif_detail;
            $ExtraKM = $TotalKm - $AllowedKM;
            
            if($ExtraKM > 0){
                $Booking->additional_km_reunning = $ExtraKM ;
                $ExtraAmount = ($Booking->additional_kilometers_amount * $ExtraKM);
                $subTotal += $ExtraAmount;   
            } else {
                $Booking->additional_km_reunning = 0;
            }
            
            $Booking->sub_total = $subTotal;
            $TaxAmount = ($subTotal * 5) / 100;
            //update status
            $Booking->drop_off_confirm = 1;

            $this->_updateBillingDetails($Booking);
        }
        $Booking->status = 5;
        $Booking->save();

        $data = array();
        return json_encode(array("Status" => 1, "Message" => "Vehicle Dropped Successfully", "Data" => $data));
    }

    public function completeBooking(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input);
        $Booking = Booking::find($request->booking_id);

        $Booking->discount_amount = $Input["discount_amount"] + $Input["more_discount"];
        $Booking->sub_total = $Input["sub_total"];
        $Booking->grand_total = $Input["grand_total"];
        $Booking->discount_note = $Input["discount_note"];
        $Booking->final_amount_paid = $Input["final_amount_paid"];
        $Booking->additional_charges = $Input["additional_charges"];
        $Booking->status = 3;
        $Booking->save();
        
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

        return json_encode(array("Status" => 1, "Message" => "Booking closed successfully", "Data" => $data));
    }

    public function changeDropOFF(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input);
        $Booking = Booking::find($request->booking_id);

        $curDropOff = $Booking->dropoff_date;
        $newDropOff = $Input["dropoff_date"];
        if($newDropOff > $curDropOff){
            Log::debug("postpone");
            $nextDate = date('Y-m-d', strtotime($curDropOff . ' +1 day')); // Increment the date by 1 day
            $getAvailableCartypes = $this->_getAvailableCarTypes($nextDate,$newDropOff,null);
            if($getAvailableCartypes[$Booking->car_type]<0){
                return json_encode(array("Status" => 0, "Message" => "Vehicle not available for additional days", "Data" => $Data));
            }
        } else {
            Log::debug("prepone");
        }

        $Booking->dropoff_date = $newDropOff;
        
        //update billing.. 
        Log::debug($this->_updateBillingDetails($Booking));
        $Booking->save();
        return json_encode(array("Status" => 1, "Message" => "Dates changed successfully", "Data" => array()));
    }

    public function GetBookingVehicleImages(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input);
        $Booking = Booking::find($request->booking_id);

        $BookingImages = BookingImages::select("type","link")
                        ->where('booking_id',$Input["booking_id"])
                        ->where("booking_vehicle_id",$Input["booking_vehicle_id"])
                        // ->where('booking_id',$Input["type"])
                        ->get()
                        ;
        $BookingImagesArr = [];
        foreach ($BookingImages as $imageRow) {
            $type = $imageRow->type;
            if(!isset($BookingImagesArr[$type])){
                $BookingImagesArr[$type] = []; 
            }
            array_push($BookingImagesArr[$type], $imageRow->link);
        }
        // Log::debug($BookingImagesArr);
        $data = array("BookingImagesArr" => $BookingImagesArr);
        return json_encode(array("Status" => 1, "Message" => "Images fetched successfully", "Data" => $data));
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

    protected function _updateBillingDetails($Booking){
        $DopDate = new DateTime($Booking->dropoff_date);
        $pickupDate = new DateTime(substr($Booking->pickup_date_time, 0, 10));
        
        $interval = $DopDate->diff($pickupDate);
        $numberOfDays = $interval->days;
        if($numberOfDays==0){
            $Booking["tarrif_detail"] = 0;
            $numberOfDays = 1;
        } else 
            $Booking["tarrif_detail"] = $numberOfDays;


        $GetPricing = Pricing::where("car_type", $Booking->car_type)->first();
        Log::debug($GetPricing);

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

        $Amount = $this->rent_calculation($numberOfDays, $GetPricing);
        $Total = $Amount;
        
        $Amount -= $Booking["discount_amount"]; 
        // $Amount -= $Booking["advance_amount"];
        $SubTotal = $Amount;           
        
        $TaxAmount = ($SubTotal * 5) / 100;
        $GrandTotal = $SubTotal + $TaxAmount;
    
        // $Booking["tarrif_detail"] = $numberOfDays;
        $Booking["total"] = $Total;
        $Booking["sub_total"] = $SubTotal;
        $Booking["grand_total"] = $GrandTotal;

        return array(
            "total" => $Total,
            "discount" => $Booking["discount_amount"],
            "advance_amount" => $Booking["advance_amount"],
            "sub_total" => $SubTotal,
            "tax" => $TaxAmount,
            "grand_total" => $GrandTotal
        );
    }
    
    protected function _getAvailableCarTypes($pickupDate,$dropoffDate,$booking_id){
        Log::debug($pickupDate);
        $getAllVehicleResp = collect();

        try {
            $GetAllVehicles = DB::table('vehicles')
                        ->selectRaw('car_type, count(*) as count')
                        ->where("company_id",session("CompanyLinkID"))
                        ->where("status",1)
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get()
                        ;

            foreach ( $GetAllVehicles as $obj ){
                $getAllVehicleResp[$obj->car_type] = $obj->count;
            }

            $today = date("Y-m-d");
            if($booking_id != null){
                $query = 'select car_type from bookings where company_id = '.session("CompanyLinkID")
                    .' and (id != '.$booking_id.')' //by default this argument is null... so no worry
                    .' and (status = 1 and pickup_date_time >= \''.$today.'\' )'
                    .' and ((status = 1 and pickup_date_time <= \''.$dropoffDate.'\' and dropoff_date >= \''.$pickupDate.'\') or ' 
                    .' ( status = 2 and pickup_date_time <= \''.$dropoffDate.'\' ))'
                ;
            } else {
                $query = 'select car_type from bookings where company_id = '.session("CompanyLinkID")
                    .' and (status = 1 and pickup_date_time >= \''.$today.'\' )'
                    .' and ((status = 1 and pickup_date_time <= \''.$dropoffDate.'\' and dropoff_date >= \''.$pickupDate.'\') or ' 
                    .' ( status = 2 and pickup_date_time <= \''.$dropoffDate.'\' ))'
                ;
            }
                        
            Log::info($query);
            $GetAllBookings = DB::select($query);
            foreach ($GetAllBookings as $obj){
                if( !isset($getAllVehicleResp[$obj->car_type]) ) 
                    $getAllVehicleResp[$obj->car_type] = 0;
                $getAllVehicleResp[$obj->car_type] -= 1;
            }            
        } catch(Exception $e){
            echo $e.getMessage();
        }
        Log::debug($getAllVehicleResp);
        return $getAllVehicleResp;
    }
}
