<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Session;
use Mail;
use Excel;

use App\Models\Vehicle;
use App\Models\Booking;
use App\Models\BookingImages;
use App\Models\BookingVehicles;
use App\Models\Office;
use App\Models\CarType;

use Log;
use DB;

class BookingVehiclesController extends Controller
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

        //echo '<pre>';print_r($request->status); echo '</pre>';die();
        $Data = BookingVehicles::where("company_id", session("CompanyLinkID"));

        $ActiveAction = "bookingVehicles";
        return view('bookingVehicles.view', compact("Data","ActiveAction"));
    }

}