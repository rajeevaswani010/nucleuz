<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;

use App\Models\Vehicle;
use App\Models\Pricing;
use App\Models\Booking;
use App\Models\BookingInvite;
use App\Models\Customer;

use Log;
use DB;

class ReportController extends Controller{

    public function View(Request $request){

        if(session("AdminID") == ""){
            return redirect("/");
        }

        $Input = $request->all();
    
        Log::debug("Reports page view filters ---- report type: ".$request->report_type
            ." , vehicle type: ".$request->vehicle_type
            ." , from: ".$request->from_date
            ." , to: ".$request->to_date
        );

        switch($request->report_type){

            case "On Rent":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 2)
                        ->join('vehicles','vehicles.id','=','bookings.vehicle_id')
                        ->join('customers', 'customers.id', '=','bookings.customer_id')
                        ->get(['bookings.id','bookings.car_type','vehicles.reg_no','customers.first_name','customers.last_name','customers.mobile'])
                        ;
        
                /*above eloquent results in below query ... 
                SELECT `bookings`.`id`, `bookings`.`car_type`, `vehicles`.`reg_no`, `customers`.`first_name`, 
                    `customers`.`last_name`, `customers`.`mobile` FROM `bookings` 
                    INNER JOIN `vehicles` ON `vehicles`.`id` = `bookings`.`vehicle_id` 
                    INNER JOIN `customers` ON `customers`.`id` = `bookings`.`customer_id` 
                    WHERE bookings.company_id = 3 
                    AND bookings.status = 2;
                    */
                if($request->vehicle_type != ""){
                    Log::debug("vehicle type - ".$request->vehicle_type);
                    $Data = $Data->where("car_type",strtolower($request->vehicle_type) );                
                }
                // Log:info("count - ".$Data->count());
                $ActiveAction = "reports";
                return view('reports.view', compact("Data", "ActiveAction"));

            case "Available":
                $GetAllVehicles = DB::table('vehicles')
                        ->selectRaw('lower(car_type) as car_type, count(*) as count')
                        ->where("company_id",session("CompanyLinkID"))
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get()
                ;

                Log::info(json_encode($GetAllVehicles));
                $Data = collect();
                foreach ( $GetAllVehicles as $obj ){
                    $Data[$obj->car_type] = $obj->count;
                }

                $query = 'select lcase(car_type) as car_type from bookings where company_id = '.session("CompanyLinkID")
                        .' and status != 4 and pickup_date_time <= \''.$request->pickupDate.' 23:59:59\' and dropoff_date >= \''.$request->pickupDate.' 00:00:00\'';
                            
                //Log::info($query);
                $GetAllBookings = DB::select($query);
                foreach ($GetAllBookings as $obj){
                    $Data[$obj->car_type] -= 1;
                }
                
                $ActiveAction = "reports";
                return view('reports.view', compact("Data", "ActiveAction"));

            case "Reservation":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 1)
                ->join('customers','customers.id','=','bookings.customer_id')
                ->get(['bookings.id','bookings.car_type','customers.first_name','customers.mobile']);

                if($request->vehicle_type != null){
                    $Data = $Data->where("bookings.car_type",strtolower($request->vehicle_type) );                
                }

                if ($request->from_date != null){
                    $Data = $Data->where("bookings.pickup_date_time",">=",$request->from_date." 00:00:00");
                }

                if ($request->to_date != null){
                    $Data = $Data->where("bookings.pickup_date_time","<=",$request->to_date." 23:59:59");
                }

                $ActiveAction = "reports";
                return view('reports.view', compact("Data", "ActiveAction"));

            case "Returns":
                $Data = Booking::where('bookings.company_id', session("CompanyLinkID"))->where('bookings.status', 2)
                ->join('customers','customers.id','=','bookings.customer_id')
                ->join('vehicles','vehicles.id','=','bookings.vehicle_id')
                ->get(['bookings.id','bookings.car_type','vehicles.reg_no','customers.first_name','customers.last_name','customers.mobile','bookings.dropoff_date'])
                ;

                if($request->vehicle_type != null){
                    $Data = $Data->where("bookings.car_type",strtolower($request->vehicle_type) );                
                }

                if ($request->from_date != null){
                    $Data = $Data->where("bookings.dropoff_date",">=",$request->from_date." 00:00:00");
                }

                if ($request->to_date != null){
                    $Data = $Data->where("bookings.dropoff_date","<=",$request->to_date." 23:59:59");
                }

                $ActiveAction = "reports";
                return view('reports.view', compact("Data", "ActiveAction"));

            case "Billing":
            default:
                $ActiveAction = "reports";
                return view('reports.view', compact("ActiveAction"));
        }

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
