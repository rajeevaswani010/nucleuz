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

class ReportController extends Controller{

    public function View(Request $request){

        if(session("AdminID") == ""){
            return redirect("/");
        }
    
        $Data = Vehicle::where("company_id", session("CompanyLinkID"));
        //  echo '<pre>';print_r($request->report_type);echo '</pre>';die();

        $GetVehicleIDS = array();
        if($request->report_type != ""){
            if($request->report_type == "On Rent"){


                $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("status", 1)->get()->pluck("vehicle_id")->toArray();

                // echo '<pre>';print_r($GetBooking);echo '</pre>';die();

                $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
            }

            if($request->report_type == "Reservation"){
                $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", date("Y-m-d")." 00:00:00")->where("status", 1)->get()->pluck("vehicle_id")->toArray();
                $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
            }

            if($request->report_type == "Returns"){
                $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("dropoff_date", "=", date("Y-m-d"))->where("status", 1)->get()->pluck("vehicle_id")->toArray();
                $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
            }

            if($request->report_type == "Available"){
                $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("status", 2)->get()->pluck("vehicle_id")->toArray();
                $VhIDs = Vehicle::select("id")->where("company_id", session("CompanyLinkID"))->whereNotIn("id", $GetBooking)->get()->pluck("id")->toArray();
                $GetVehicleIDS = array_merge($GetVehicleIDS, $VhIDs);
            }

            if($request->report_type == "Billing"){
                $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("status", 1)->get()->pluck("vehicle_id")->toArray();
                $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
            }
        }

        if($request->from_date != ""){
            $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", $request->from_date." 00:00:00")->where("status", 1)->get()->pluck("vehicle_id")->toArray();
            $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
        }

        if($request->to_date != ""){
            $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("pickup_date_time", "<=", $request->to_date." 23:59:59")->where("status", 1)->get()->pluck("vehicle_id")->toArray();
            $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
        }

        if($request->vehicle_type != ""){
            $Data = $Data->where("car_type", $request->vehicle_type);
        }

        if($request->vehicle_type == "" && $request->report_type == ""){

            $GetBooking = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->get()->pluck("vehicle_id")->toArray();
            $GetVehicleIDS = array_merge($GetVehicleIDS, $GetBooking);
            // echo '<pre>';print_r($GetVehicleIDS);echo '</pre>';die();

        }

        $GetVehicleIDS = array_filter($GetVehicleIDS);
        $Data = $Data->whereIn("id", $GetVehicleIDS);
        $Data = $Data->latest()->get();

        // echo '<pre>';print_r($Data);echo '</pre>';die();

        $ActiveAction = "reports";
        return view('reports.view', compact("Data", "ActiveAction"));
    }
}
