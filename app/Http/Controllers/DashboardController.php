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
		if(session("AdminID") == ""){
            return redirect("/");
        }

		$TodayPickup = Booking::where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", date("Y-m-d")." 00:00:00")->where("pickup_date_time", "<=", date("Y-m-d")." 23:59:59")->where("status", "!=", 4)->count();
		
		$TomorrowPickup = Booking::where("company_id", session("CompanyLinkID"))->where("pickup_date_time", ">=", date("Y-m-d", strtotime("+1 day"))." 00:00:00")->where("pickup_date_time", "<=", date("Y-m-d", strtotime("+1 day"))." 23:59:59")->where("status", "!=", 4)->count();


		$pickupDateTime = date('Y-m-d')." 00:00";
		$dropDateTime = date('Y-m-d')." 23:59:59";//, strtotime("$pickupDateTime +1 days"))." 10:00";

		// $GetBooking = Booking::select("car_type")
		// 			->where("company_id", session("CompanyLinkID"))->whereIn("status", [1,2])
		// 			->where("pickup_date_time","<=",$dropDateTime)->where("dropoff_date",">=",$pickupDateTime)->count();
		// $VhIDs = Vehicle::select("id")->where("company_id", session("CompanyLinkID"))->count();
		$GetAllVehicles = DB::table('vehicles')
					->selectRaw('car_type as car_type, count(*) as count')
					->where("company_id",session("CompanyLinkID"))
					->orderBy('car_type')
					->count();

		$query = 'select car_type from bookings where company_id = '.session("CompanyLinkID").
		' and ((status = 1 and pickup_date_time <= \''.$dropDateTime.'\' and dropoff_date >= \''.$pickupDateTime.'\') or '.
		' ( status = 2 and pickup_date_time <= \''.$dropDateTime.'\' ))';
		Log::debug($query);
        $GetBooking = DB::select($query);
		$VehicleAvaialble = $GetAllVehicles - sizeof($GetBooking);

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

		$VehicleDataByCarType = DB::table('bookings')
					->selectRaw('car_type, count(*) as count')
					->where("company_id",session("CompanyLinkID"))
					->groupBy('car_type')
					->orderBy('car_type')
					->get();
		$VehicleDataByCarTypeArr = collect();
		foreach($VehicleDataByCarType as $elmt){
			$VehicleDataByCarTypeArr[$elmt->car_type] = $elmt->count; 
		}
		Log::debug(json_encode($VehicleDataByCarType));
		
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

		$query = 'SELECT Month(pickup_date_time) as month, COUNT(*) as count FROM `bookings`'. 
				' where company_id='.session("CompanyLinkID"). ' AND status !=4'.' group BY month';
			
		$BookingData2 = DB::select($query);
		$months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		$BookingDataArr = collect();
		foreach($months as $m){
			$BookingDataArr[$m] = 0;
		}
		foreach($BookingData2 as $elmt){
			$BookingDataArr[$months[$elmt->month-1]] = $elmt->count; 
			$MonthArray[$months[$elmt->month-1]] = $elmt->count; 
		}
		Log::debug(json_encode($BookingDataArr));
		
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
					"Return", 
					"HatchbackBooking", 
					"SedanBooking", "SUVBooking", "MUVBooking", "CoupeBooking", "VehicleDataByCarTypeArr",
					"ConvertiblesBooking", "PickupBooking", 
					"MonthArray","BookingDataArr","totalActiveLicense",
					"totalLicenseProduct","suspendedlicensecount"
				));
    }

	public function dashboardAdmin(){
		//for admin users.. show this
	}

	public function dashboardSuperAdmin(){
		//for super admin.. show this
	}

	public function GetBookings( Request $request){
		if(session("AdminID") == ""){
            return redirect("/");
        }

        $from = $request->start;
        $to = $request->end;
        $Data = Booking::select(
                    DB::raw('CAST(pickup_date_time AS DATE) AS start'),
                    DB::raw('count(*) as title'),
                )
                ->where("company_id", session("CompanyLinkID"))
                ->whereIn("status",[1,2])
                ->where("pickup_date_time",">=",$from." 00:00:00")
                ->where("pickup_date_time","<=",$to." 23:59:59")
                ->groupBy('start')
                ->get();

        foreach($Data as $dt){
            $dt->url = "/booking?from_date=".$dt->start."&to_date=".$dt->start."&status=1";
        }
        Log::debug(json_encode($Data));
        return json_encode($Data);
    }

	public function GetBookingGroupByVehicleType( Request $request){
		if(session("AdminID") == ""){
            return redirect("/");
        }

		$Data = DB::table('bookings')
				->selectRaw('lower(car_type) as car_type, count(*) as count')
				->where("company_id",session("CompanyLinkID"))
				->groupBy('car_type')
				->orderBy('car_type')
				->get();

        Log::debug(json_encode($Data));
        return json_encode($Data);
	}

}