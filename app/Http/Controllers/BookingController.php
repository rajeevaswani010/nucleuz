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
use App\Models\Office;

use Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        Log::info('first log ***************************** Request:'.json_encode($request));
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
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

        $Data = $Data->orderBy("id", "DESC")->get();
        
        if(isset($request->export) && $request->export == "Export"){
            return Excel::download(new BookingExport($Data), 'Booking.xlsx');
        }
        $ActiveAction = "booking";
        return view('booking.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "booking";
        $AllVehicles = Vehicle::where("company_id", session("CompanyLinkID"))->get();
        $AllPricing = Pricing::where("company_id", session("CompanyLinkID"))->get();
        $CustomerID = @$request->id;
        $CustomerData = array();
        if(isset($request->id)){
            $CustomerData = Customer::where("company_id", session("CompanyLinkID"))->find($CustomerID);
        }
        
        $Conuntry = Country::orderBy("name")->get();
        return view('booking.add', compact("ActiveAction", "AllVehicles", "AllPricing", "CustomerData", "Conuntry"));
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
        $CustomerID = "";
        $CheckCustomer = Customer::where("company_id", session("CompanyLinkID"))->get();
        
        $CustomerFound = 0;
        
        
        if($Input["payment_mode"] == "Card"){
            if($request->file('card_details') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Card Details"));
            }
        }
        
        foreach($CheckCustomer as $Cms){
            if($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->email == $Input["email"]){
                $CustomerFound = 1;
            }
            
            if($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"]){
                $CustomerFound = 1;
            }
            
            if($Cms->first_name == $Input["first_name"] && $Cms->last_name == $Input["last_name"] && $Cms->dob == $Input["dob"]){
                $CustomerFound = 1;
            }
            
            if($Cms->email == $Input["email"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"]){
                $CustomerFound = 1;
            }
            
            if($Cms->email == $Input["email"] && $Cms->dob == $Input["dob"]){
                $CustomerFound = 1;
            }
            
            if($Cms->dob == $Input["dob"] && $Cms->mobile == $Input["mobile"] && $Cms->country_code == $Input["country_code"]){
                $CustomerFound = 1;
            }
            
            if($CustomerFound == 1){
                $CustomerID = $Cms->id;
            }
        }
        
        if($CustomerID == ""){
            if($request->file('driving_license') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Driving License File"));
            }

            if($request->file('passport_detail') == null && $request->file('residency_card') == null){
                return json_encode(array("Status" =>  0, "Message" => "Upload Passport File or Residency Card"));
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
        }
        
        if($Input["additional_kilometers_amount"] <= 0){
            return json_encode(array("Status" =>  0, "Message" => "Additional KM Amount Must Be > 0"));
        }
        
        if($Input["PickupDate"]." ".$Input["PickupTime"] < date("Y-m-d H:i:s")){
            return json_encode(array("Status" =>  0, "Message" => "Pickup Date Can't Be in Past"));
        }

        $BookingObj = new Booking();
        $BookingObj->staff_id = session("AdminID");
        $BookingObj->company_id = session("CompanyLinkID");
        $BookingObj->customer_id = $CustomerID;
        $BookingObj->car_type = $Input["vehicle_id"];
        $BookingObj->tarrif_detail = $Input["tarrif_detail"];
        $BookingObj->tarrif_type = $Input["tarrif_type"];
        $BookingObj->discount_amount = $Input["discount_amount"];

        $MultiplyDay = 1;
        if($Input["tarrif_type"] == "Weekly"){
            $MultiplyDay = 7;
        }
        if($Input["tarrif_type"] == "Monthly"){
            $MultiplyDay = 30;
        }

        $Day = $Input["tarrif_detail"] * $MultiplyDay;
        $DopDate = date("Y-m-d H:i:s", strtotime("+".$Day." days", strtotime($Input["PickupDate"])));
        
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

        $Amount = $BasePrice * $Input["tarrif_detail"];
        $Amount -= $Input["discount_amount"];
        
        $TaxAmount = ($Amount * 5) / 100;
        $SubTotal = $Amount;
        $Amount += $TaxAmount;
        

        $BookingObj->sub_total = $SubTotal;
        $BookingObj->grand_total = $Amount;
        $BookingObj->tarrif_amount = $BasePrice;
        $BookingObj->save();

        $BookingObj = Booking::find($BookingObj->id);

        $data = array("Booking" => $BookingObj);
        Mail::send("EmailTemplates.Booking", $data, function ($m) use($BookingObj){
            $m->from("no-reply@nucleuz.app", "Nucleuz");
            $m->to($BookingObj->customer->email)->subject("New Car Booking");
        });

        $CheckInvite = BookingInvite::where("email", $Input["email"])->count();
        if($CheckInvite > 0){
            BookingInvite::where("email", $Input["email"])->delete();
        }

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

        // echo 'sdfjkdsl';die();
        $Booking = Booking::find($id);
        $BookedVehicle = Booking::select("vehicle_id")->where("company_id", $Booking->company_id)->where("pickup_date_time", "<=", $Booking->pickup_date_time)->where("status", "!=", "3")->get()->pluck("vehicle_id")->toArray();
        $BookedVehicle = array_filter($BookedVehicle);
        $AllVehicles = Vehicle::whereNotIn("id", $BookedVehicle)->where("car_type", $Booking->car_type)->where("company_id", $Booking->company_id)->get();
        $ActiveAction = "booking";
        return view('booking.show', compact("Booking", "ActiveAction", "AllVehicles"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Booking = Booking::find($id);
        
        $ActiveAction = "booking";
        return view('booking.edit', compact("Booking", "ActiveAction"));
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
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Booking = Booking::find($id);

        $Input = $request->all();
        
        if(isset($Input["km_drop_time"])){
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
            $ExtraAmount = $ExtraAmount + trim($Input["additional_charges"]);
            
            
            $Amount = $Booking->sub_total + $ExtraAmount + $Input["additional_charges"];
            $Amount -= $Input["discount_amount"];
            
            $TaxAmount = ($Amount * 5) / 100;
            $SubTotal = $Amount;
            $Amount += $TaxAmount;
            
            $Input["sub_total"] = $SubTotal;
            $Input["grand_total"] = $Amount;
            $Input["additional_km_reunning"] = $Extra;
            $Input["dropoff_date"] = date("Y-m-d H:i:s");
        }

        unset($Input["_method"]);
        unset($Input["_token"]);
        
        if($request->file('damge_image') != null){
            $path = $request->file('damge_image')->store('BookimngImages');
            $Input['damge_image'] = $path;
        }
        
        
        if(isset($Input["final_amount_paid"])){
            $Input["status"] = 3;
        }
        
        
        if($request->file('car_image') != null){
            $path = $request->file('car_image')->store('BookimngImages');
            $Input['car_image'] = $path;
        }
        
        if(isset($Input["km_reading_pickup"])){
            $Input["status"] = 2;
        }

        Booking::where('id', $id)->update($Input);
        
        
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
            Mail::send("EmailTemplates.Booking2", $data, function ($m) use($Booking){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($Booking->customer->email)->subject("New Car Booking");
            });
        }
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
        $Input = $request->all();
        unset($Input["_method"]);
        unset($Input["_token"]);
        
        $GetBooking = Booking::find($id);
        $Input["dropoff_date"] = $Input["dropoff_date"]." ".$Input["dropoff_time"];
        $ExtraDay = $this->time_difference ($GetBooking->dropoff_date, $Input["dropoff_date"], "day");
        
        $ExtraAmount = (float)$ExtraDay * $GetBooking->tarrif_amount;
        $SubTotal = $GetBooking->sub_total + $ExtraAmount;
        $GrandTotal = $GetBooking->grand_total + $ExtraAmount;
        
        $Input["sub_total"] = $SubTotal;
        $Input["grand_total"] = $GrandTotal;
        
        unset($Input["dropoff_time"]);
        Booking::where('id', $id)->update($Input);
        return redirect("booking/".$id."/edit");
    }
    
    function time_difference($time_1, $time_2, $limit = null){
        $val_1 = new \DateTime($time_1);
        $val_2 = new \DateTime($time_2);
        $interval = $val_1->diff($val_2);
        
        $output = array(
            "year" => $interval->y,
            "month" => $interval->m,
            "day" => $interval->d,
            "hour" => $interval->h,
            "minute" => $interval->i,
            "second" => $interval->s
        );
        
        $return = "";
        foreach ($output AS $key => $value) {
            if ($value == 1)
                $return .= $value;
            elseif ($value >= 1)
                $return .= $value;
            
            if ($key == $limit)
            return trim($return);
        }
        return trim($return);
    }

    public function review(Request $request){
        try{
            $Input = $request->all();
            $GetPricing = Pricing::where("company_id", session("CompanyLinkID"))->where("car_type", $Input["vehicle"])->first();

            $BasePrice = 0;
            if($Input["tarrif"] == "Daily"){
                if(isset($GetPricing->daily_pricing)){
                    $BasePrice = $GetPricing->daily_pricing;
                }
            }

            if($Input["tarrif"] == "Weekly"){
                if(isset($GetPricing->weekly_pricing)){
                    $BasePrice = $GetPricing->weekly_pricing;
                }
            }

            if($Input["tarrif"] == "Monthly"){
                if(isset($GetPricing->monthly_pricing)){
                    $BasePrice = $GetPricing->monthly_pricing;
                }
            }

            $Amount = $BasePrice * $Input["days"];
            
            $DiscountAmount = number_format($Input["discount"], 2);
            $Amount -= $Input["discount"];
            
            
            $TaxAmount = ($Amount * $Input["tax"]) / 100;
            $SubTotal = number_format($Amount, 2);
            $Amount += $TaxAmount;
            

            $TaxAmount = number_format($TaxAmount, 2);

            $AdvanceAmount = 0;
            $DueAmount = 0;

            $DueAmount = $Amount;
            $Amount = number_format($Amount, 2);

            return json_encode(array("GrandTotal" => $Amount, "Tax" => $TaxAmount, "SubTotal" => $SubTotal, "Discount" => $DiscountAmount, "Due" => number_format($DueAmount, 2), "Advance" => $AdvanceAmount));
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function CancelBooking($id){
        $Booking = Booking::find($id);
        $Booking->status = 4;
        $Booking->grand_total = 0;
        $Booking->save();
        return redirect("booking");
    }
    
    public function ReviewCustomer(Request $request){
        try{
            $Input = $request->all();
            $GetPricing = Pricing::where("company_id", $Input["company"])->where("car_type", $Input["vehicle"])->first();

            $BasePrice = 0;
            if($Input["tarrif"] == "Daily"){
                if(isset($GetPricing->daily_pricing)){
                    $BasePrice = $GetPricing->daily_pricing;
                }
            }

            if($Input["tarrif"] == "Weekly"){
                if(isset($GetPricing->weekly_pricing)){
                    $BasePrice = $GetPricing->weekly_pricing;
                }
            }

            if($Input["tarrif"] == "Monthly"){
                if(isset($GetPricing->monthly_pricing)){
                    $BasePrice = $GetPricing->monthly_pricing;
                }
            }

            $Amount = $BasePrice * $Input["days"];
            $TaxAmount = ($Amount * $Input["tax"]) / 100;
            $SubTotal = number_format($Amount, 2);
            $DiscountAmount = 0;
            $Amount += $TaxAmount;
            $TaxAmount = number_format($TaxAmount, 2);

            $AdvanceAmount = 0;
            $DueAmount = number_format($Amount, 2);
            $Amount = number_format($Amount, 2);

            return json_encode(array("GrandTotal" => $Amount, "Tax" => $TaxAmount, "SubTotal" => $SubTotal, "Discount" => $DiscountAmount, "Due" => number_format($DueAmount, 2), "Advance" => $AdvanceAmount));
        }catch(\Exception $e){

        }
    }
}
