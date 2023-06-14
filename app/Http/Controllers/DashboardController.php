<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\BookingInvite;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Office;
use App\Models\License;
use App\Models\Subscription;

use Log;
use DB;

class DashboardController extends Controller
{
	public function index(){
		$TodayPickup = Booking::where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", date("Y-m-d")." 00:00:00")->where("pickup_date_time", "<=", date("Y-m-d")." 23:59:59")->where("status", "!=", 4)->count();
		
		$TomorrowPickup = Booking::where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", date("Y-m-d", strtotime("+1 day"))." 00:00:00")->where("pickup_date_time", "<=", date("Y-m-d", strtotime("+1 day"))." 23:59:59")->where("status", "!=", 4)->count();


		$pickupDateTime = date('Y-m-d')." 00:00";
		$dropDateTime = date('Y-m-d')." 23:59:59";//, strtotime("$pickupDateTime +1 days"))." 10:00";

		// $GetBooking = Booking::select("car_type")
		// 			->where("company_id", session("CompanyLinkID"))->whereIn("status", [1,2])
		// 			->where("pickup_date_time","<=",$dropDateTime)->where("dropoff_date",">=",$pickupDateTime)->count();
		// $VhIDs = Vehicle::select("id")->where("company_id", session("CompanyLinkID"))->count();
		$GetAllVehicles = DB::table('vehicles')
					->selectRaw('lower(car_type) as car_type, count(*) as count')
					->where("company_id",session("CompanyLinkID"))
					->orderBy('car_type')
					->count();

		$GetBooking = Booking::selectRaw('lower(car_type) as car_type')
					->where("company_id",session("CompanyLinkID"))
					->whereIn("status",[1,2])
					->where("pickup_date_time","<=",$dropDateTime)
					->where("dropoff_date",">=",$pickupDateTime)
					->count()	;
		$VehicleAvaialble = $GetAllVehicles - $GetBooking;

		$OnRentVehicle = Booking::select("vehicle_id")->where("company_id", session("CompanyLinkID"))->where("status", 2)->where("pickup_date_time","<=",date("Y-m-d H:i:s"))->count();
		$Return = Booking::where("company_id", session("CompanyLinkID"))->where("dropoff_date", ">=", date("Y-m-d")." 00:00:00")->where("dropoff_date", "<=", date("Y-m-d")." 23:59:59")->where("status", 2)->count();

		$Invite = BookingInvite::where("company_id", session("CompanyLinkID"))->where("status",1)->count(); //registered invites.. 
		//$ToalBooking = Booking::where("company_id", session("CompanyLinkID"))->count();
		$Reservation = $Invite;// - $ToalBooking;

		$HatchbackBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "Hatchback")->count();
		$SedanBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "Sedan")->count();
		$SUVBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "SUV")->count();
		$MUVBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "MUV")->count();
		$CoupeBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "Coupe")->count();
		$ConvertiblesBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "Convertibles")->count();
		$PickupBooking = Booking::where("company_id", session("CompanyLinkID"))->where("car_type", "Pickup Trucks")->count();

		$BookingData = Booking::where("company_id", session("CompanyLinkID"))->get();
		$MonthArray = array();

		$MonthArray["Jan"] = 0;
		$MonthArray["Feb"] = 0;
		$MonthArray["Mar"] = 0;
		$MonthArray["Apr"] = 0;
		$MonthArray["May"] = 0;
		$MonthArray["Jun"] = 0;
		$MonthArray["Jul"] = 0;
		$MonthArray["Aug"] = 0;
		$MonthArray["Sep"] = 0;
		$MonthArray["Oct"] = 0;
		$MonthArray["Nov"] = 0;
		$MonthArray["Dec"] = 0;

		foreach($BookingData as $BD){
			$MonthArray[date("M", strtotime($BD->pickup_date_time))]++;
		}
		
		$ActiveAction = "dashboard";
		
		$NumUser = License::count();
		$AllCompany = Office::count();
		
		
		$ExpLic = 0;
		$totalLicenseProduct=0;
		$ExpLic=License::where('status','inactive')->count();
		$suspendedlicensecount=License::where('status','suspended')->count();
		$totalActiveLicense=$NumUser-$ExpLic;
		$totalLicenseProduct=License::distinct()->count('license_module');

		// $GetLicenses = Subscription::select("company_id")->where("end_date", "<", date("Y-m-d"))->orderBy("id", "DESC")->get()->pluck("company_id")->toArray();
	    
		// foreach($GetLicenses as $GLD){
		//     $CheckExpiry = Subscription::where("end_date", ">=", date("Y-m-d"))->where("company_id", $GLD)->count();
		//     if($CheckExpiry == 0){
    	// 	    $ExpLic++;
		//     }
		// }

		return view('dashboard', 
			compact("ActiveAction", "NumUser", "AllCompany", 
					"ExpLic", "TodayPickup", "TomorrowPickup", 
					"VehicleAvaialble", "OnRentVehicle", "Reservation", 
					"Return", "HatchbackBooking", 
					"SedanBooking", "SUVBooking", "MUVBooking", "CoupeBooking", 
					"ConvertiblesBooking", "PickupBooking", "MonthArray","totalActiveLicense",
					"totalLicenseProduct","suspendedlicensecount"
					));
    }
}