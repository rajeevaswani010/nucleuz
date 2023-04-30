<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Excel;

use App\Export\VehicleExport;
use App\Import\VehicleImport;

use App\Models\Vehicle;
use App\Models\Brand;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Data = Vehicle::where("company_id", session("CompanyLinkID"))->latest()->get();
        $ActiveAction = "vehicle";
        return view('vehicle.view', compact("Data", "ActiveAction"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(session("AdminID") == ""){
            return redirect("/");
        }

        $ActiveAction = "vehicle";
        $AllBrands = Brand::get();
        return view('vehicle.add', compact("ActiveAction", "AllBrands"));
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
        $Input["company_id"] = session("CompanyLinkID");

        if($request->file('car_image') != null){
            $path = $request->file('car_image')->store('VehicleImages');
            $Input["car_image"] = $path;
        }

        if($request->file('car_condition_image') != null){
            $path = $request->file('car_condition_image')->store('VehicleImages');
            $Input["car_condition_image"] = $path;
        }

        if($request->file('mulkiya_details') != null){
            $path = $request->file('mulkiya_details')->store('VehicleImages');
            $Input["mulkiya_details"] = $path;
        }

        $Office = Vehicle::create($Input);
        return redirect("vehicle");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        
        $Data = Vehicle::find($id);
        $AllBrands = Brand::get();
        $ActiveAction = "vehicle";
        return view('vehicle.edit', compact("Data", "ActiveAction", "AllBrands"));
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
        $Input = $request->all();
        unset($Input["_method"]);
        unset($Input["_token"]);

        if($request->file('car_image') != null){
            $path = $request->file('car_image')->store('VehicleImages');
            $Input["car_image"] = $path;
        }

        if($request->file('car_condition_image') != null){
            $path = $request->file('car_condition_image')->store('VehicleImages');
            $Input["car_condition_image"] = $path;
        }
        
        if($request->file('mulkiya_details') != null){
            $path = $request->file('mulkiya_details')->store('VehicleImages');
            $Input["mulkiya_details"] = $path;
        }
        
        Vehicle::where('id', $id)->update($Input);
        return redirect("vehicle");
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
        
        Vehicle::find($id)->delete();
        return redirect("vehicle");
    }

    public function Exports(){
        $Data = Vehicle::where("company_id", session("CompanyLinkID"))->latest()->get();
        return Excel::download(new VehicleExport($Data), 'Vehicle.xlsx');
    }

    public function Import(Request $request){
        $path = $request->file('ExcelFile')->store('ExcelFile');
        Excel::import(new VehicleImport, $path);
        return redirect()->back();
    }
}
