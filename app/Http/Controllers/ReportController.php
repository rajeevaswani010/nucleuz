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

class ReportController extends Controller{

    public function View(Request $request){

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
