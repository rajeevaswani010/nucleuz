<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;
use StdClass;

use App\Models\Vehicle;
use App\Models\Pricing;
use App\Models\Booking;
use App\Models\BookingInvite;
use App\Models\Customer;
use App\Models\CarType;

use Log;
use DB;


class ReportController extends Controller{

    public function View(Request $request){

        if(session("AdminID") == ""){
            return redirect("/");
        }

        $GetAllVehicleTypes = CarType::get();

        $Input = $request->all();
    
        Log::debug("Reports page view filters ---- report type: ".$request->report_type
            ." , vehicle type: ".$request->vehicle_type
            ." , from: ".$request->from_date
            ." , to: ".$request->to_date
        );

        switch($request->report_type){
            case "On Rent":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))
                        ->where('bookings.status', 2)
                        ->where("pickup_date_time","<=",date("Y-m-d H:i:s"))
                        ->join('vehicles','vehicles.id','=','bookings.vehicle_id')
                        ->join('customers', 'customers.id', '=','bookings.customer_id')
                        ->get(['bookings.id','vehicles.make as veh_make','vehicles.model as veh_model','vehicles.variant as veh_variant',
                                'vehicles.car_type','vehicles.reg_no','customers.first_name AS cust_first_name',
                                'customers.last_name as cust_last_name','customers.mobile as cust_mobile',
                                'customers.email as cust_email','bookings.pickup_date_time','bookings.dropoff_date'
                            ])  ;
        
                /*above eloquent results in below query ... 
                SELECT `bookings`.`id`, `bookings`.`car_type`, `vehicles`.`reg_no`, `customers`.`first_name`, 
                    `customers`.`last_name`, `customers`.`mobile` FROM `bookings` 
                    INNER JOIN `vehicles` ON `vehicles`.`id` = `bookings`.`vehicle_id` 
                    INNER JOIN `customers` ON `customers`.`id` = `bookings`.`customer_id` 
                    WHERE bookings.company_id = 3 
                    AND bookings.status = 2;
                    */
                if($request->vehicle_type != ""){
                    $Data = $Data->where("car_type",$request->vehicle_type);                
                }

                Log::info(json_encode($Data));
                break;
            case "Available":
                Log::debug("inside available");
                $GetAllVehicles = DB::table('vehicles')
                            ->selectRaw('car_type, count(*) as count')
                            ->where("company_id",session("CompanyLinkID"))
                            ->groupBy('car_type')
                            ->orderBy('car_type')
                            ->get()
                            ;

                Log::debug(json_encode($GetAllVehicles));
                if($request->vehicle_type != null){
                    Log::info("vehicle type - ".$request->vehicle_type);
                    $GetAllVehicles = $GetAllVehicles->where("car_type",$request->vehicle_type);       
                }

                if ($request->from_date != null){
                    $pickupDateTime = $request->from_date." 00:00";
                } else {
                    $pickupDateTime = date('Y-m-d')." 00:00";
                }

                if ($request->to_date != null){
                    $dropDateTime = date('Y-m-d')." 00:00";
                } else {
                    $dropDateTime = date('Y-m-d')." 23:59:59";
                }
                
                Log::debug(json_encode($GetAllVehicles));
                $getAllVehicleResp = collect();
                foreach ( $GetAllVehicles as $obj ){
                    $getAllVehicleResp[$obj->car_type] = $obj->count;
                }

                Log::debug(json_encode($getAllVehicleResp));

                if($request->vehicle_type != null){
                    $query = 'select car_type from bookings where company_id = '.session("CompanyLinkID")
                    .' and (car_type = "'.$request->vehicle_type.'")'
                    .' and ((status = 1 and pickup_date_time <= \''.$dropDateTime.'\' and dropoff_date >= \''.$pickupDateTime.'\') or ' 
                    .' ( status = 2 and pickup_date_time <= \''.$dropDateTime.'\' ))';
                } else {
                    $query = 'select car_type from bookings where company_id = '.session("CompanyLinkID")
                    .' and ((status = 1 and pickup_date_time <= \''.$dropDateTime.'\' and dropoff_date >= \''.$pickupDateTime.'\') or ' 
                    .' ( status = 2 and pickup_date_time <= \''.$dropDateTime.'\' ))';

                }                
                $GetAllBookings = DB::select($query);
                Log::info($query);
                foreach ($GetAllBookings as $obj){
                    $getAllVehicleResp[$obj->car_type] -= 1;
                }

                $Data = array();//$getAllVehicleResp;
                foreach ($getAllVehicleResp as $key => $value) {
                    $myObj = new stdClass();
                    $myObj->car_type = $key;
                    $myObj->count = $value;
                    array_push($Data,$myObj);
                }

                Log::info(json_encode($Data));
                break;
            case "Reservation":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 1)
                        ->join('customers','customers.id','=','bookings.customer_id')
                        ->get(['bookings.id','bookings.car_type','customers.first_name AS cust_first_name',
                                'customers.last_name as cust_last_name','customers.mobile as cust_mobile',
                                'customers.email as cust_email','bookings.pickup_date_time','bookings.dropoff_date'
                            ])  ;

                if($request->vehicle_type != null){
                    $Data = $Data->where("car_type",$request->vehicle_type);                
                }

                if ($request->from_date != null){
                    $Data = $Data->where("pickup_date_time",">=",$request->from_date." 00:00:00");
                }

                if ($request->to_date != null){
                    $Data = $Data->where("pickup_date_time","<=",$request->to_date." 23:59:59");
                }

                Log::info(json_encode($Data));
                break;
            case "Returns":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 2)
                        ->join('vehicles','vehicles.id','=','bookings.vehicle_id')
                        ->join('customers', 'customers.id', '=','bookings.customer_id')
                        ->get(['bookings.id','vehicles.make as veh_make','vehicles.model as veh_model','vehicles.variant as veh_variant',
                                'vehicles.car_type','vehicles.reg_no','customers.first_name AS cust_first_name',
                                'customers.last_name as cust_last_name','customers.mobile as cust_mobile',
                                'customers.email as cust_email','bookings.pickup_date_time','bookings.dropoff_date'
                            ])  ;

                if($request->vehicle_type != ""){
                    $Data = $Data->where("car_type",$request->vehicle_type);                
                }
            
                if ($request->from_date != null){
                    $from_date_time = $request->from_date." 00:00";
                } else {
                    $from_date_time = date('Y-m-d')." 00:00";
                }

                if ($request->to_date != null){
                    $to_date_time = $request->to_date." 23:59:59";
                } else {
                    $to_date_time = date('Y-m-d')." 23:59:59";
                }
                $Data = $Data->where("dropoff_date",">=",$from_date_time)->where("dropoff_date","<=",$to_date_time);

                Log::info(json_encode($Data));
                break;
            case "Billing":  //get only completed bookings.. 
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 3)
                        ->join('vehicles','vehicles.id','=','bookings.vehicle_id')
                        ->join('customers', 'customers.id', '=','bookings.customer_id')
                        ->get(['bookings.id','vehicles.make as veh_make','vehicles.model as veh_model','vehicles.variant as veh_variant',
                                'vehicles.car_type','vehicles.reg_no','customers.first_name AS cust_first_name',
                                'customers.last_name as cust_last_name','customers.mobile as cust_mobile',
                                'customers.email as cust_email','bookings.pickup_date_time','bookings.dropoff_date',
                                'bookings.discount_amount','bookings.grand_total'
                            ])  ;

                if($request->vehicle_type != ""){
                    $Data = $Data->where("car_type",$request->vehicle_type);                
                }
            
                if ($request->from_date != null){
                    $from_date_time = $request->from_date." 00:00";
                } else {
                    $from_date_time = date('Y-m-d')." 00:00";
                }

                if ($request->to_date != null){
                    $to_date_time = $request->to_date." 23:59:59";
                } else {
                    $to_date_time = date('Y-m-d')." 23:59:59";
                }
                $Data = $Data->where("dropoff_date",">=",$from_date_time)->where("dropoff_date","<=",$to_date_time);

                Log::info(json_encode($Data));
                break;
            default:
                $Data = array();
        }

        $ActiveAction = "reports";
        return view('reports.view', compact("Data", "GetAllVehicleTypes", "ActiveAction"));
    }

    public function View2(Request $request){

        if(session("AdminID") == ""){
            return redirect("/");
        }
    
        Log::debug("Reports page view filters ---- report type: ".$request->report_type
            ." , vehicle type: ".$request->vehicle_type
            ." , from: ".$request->from_date
            ." , to: ".$request->to_date
        );

        //  echo '<pre>';print_r($request->report_type);echo '</pre>';die();
        $Data = Vehicle::where("company_id", session("CompanyLinkID"));

        $GetVehicleIDS = array();
        if($request->report_type != ""){
            $GetBooking = Booking::where("company_id", session("CompanyLinkID"));
            Log:info("count - ".$GetBooking->count());

            if($request->report_type == "On Rent"){
                $GetBooking = $GetBooking->where("status", 2)->where("pickup_date_time","<=",date("Y-m-d")." 23:59:59");
            }

            if($request->report_type == "Reservation"){
                $GetBooking = $GetBooking->where("status", 1);
            }

            if($request->report_type == "Returns"){
                $GetBooking = $GetBooking->where("status", 2);
            }

            if($request->report_type == "Available"){
                $GetBooking = $GetBooking->where("status", 2);
            }

            if($request->report_type == "Billing"){
                $GetBooking = $GetBooking->where("status", 1);
            }

            Log::info("count - ".$GetBooking->count());

            if($request->from_date != ""){
                $GetBooking = $GetBooking->where("pickup_date_time", ">=", $request->from_date." 23:59:59");    
            }
    
            if($request->to_date != ""){
                $GetBooking = $GetBooking->where("pickup_date_time", "<=", $request->to_date." 23:59:59");
            }
    
            if($request->vehicle_type != ""){
                $GetBooking = $GetBooking->where("car_type", $request->vehicle_type);
            }
    
            $GetBookingVehicleIds = $GetBooking->get()->pluck("vehicle_id")->toArray();
            $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBookingVehicleIds);
            $Data = $Data->whereIn("id", $GetVehicleIDS);
        }
        $Data = $Data->get();
        // Log::info("Data count - ".$Data->count());
        $ActiveAction = "reports";
        return view('reports.view', compact("Data", "ActiveAction"));
    }
}
