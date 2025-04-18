<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Excel;
use Log;
use DB;

use App\Export\VehicleExport;
use App\Import\VehicleImport;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\VehicleImages;

class VehicleController extends Controller
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
        
        $Data = Vehicle::where("company_id", session("CompanyLinkID"))->latest()->get();

        if($request->car_type != ""){
            $Data = $Data->where("car_type", $request->car_type);
        }

        if($request->make != ""){
            $Data = $Data->where("make", $request->make);
        }

        $AllBrands = Brand::get();
        $AllCarTypes = CarType::get();
        // echo $Data; die;
        $ActiveAction = "vehicle";
        return view('vehicle.view', compact("Data","AllBrands","AllCarTypes","ActiveAction"));
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
        $AllCarTypes = CarType::get();
        return view('vehicle.add', compact("ActiveAction", "AllBrands","AllCarTypes"));
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

        $request->validate([
            'reg_no' => 'required|alpha_num|unique:vehicles|min:6|max:8',
            'chasis_no' => 'required|alpha_num|min:17'
            ],
            [ 'reg_no.unique'      => 'Sorry, This Registration Number Is Already Used. Please Try With Different One, Thank You.',
              'reg_no.alpha_num'      => 'Registration Number Should Be Alpha-Numeric',
              'reg_no.min'      => 'Registration Number Should Be Minimum 6 Characters',
              'reg_no.max'      => 'Registration Number Should Be Maximum 8 Characters',
              'chasis_no.alpha_num'      => 'Chasis Number Should Be Alpha-Numeric',
              'chasis_no.min'      => 'Chasis Number Should Be Minimum 17 Characters'

            ]);

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
        $Data["images"] = VehicleImages::where("vehicle_id",$id)->where("company_id",session("CompanyLinkID"))->get();
        Log::debug($Data);
        $AllBrands = Brand::get();
        $AllCarTypes = CarType::get();
        $ActiveAction = "vehicle";
        return view('vehicle.edit', compact("Data", "ActiveAction", "AllBrands","AllCarTypes"));
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
        Log::debug($Input);
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

    public function GetAllCarTypes(){
        try {
            $GetAllVehicles = DB::table('vehicles')
                        ->selectRaw('car_type as car_type, count(*) as count')
                        ->where("company_id",session("CompanyLinkID"))
                        ->groupBy('car_type')
                        ->orderBy('car_type')
                        ->get()
                        ;

            Log::info(json_encode($GetAllVehicles));
            $getAllVehicleResp = collect();
            foreach ( $GetAllVehicles as $obj ){
                $getAllVehicleResp[$obj->car_type] = $obj->count;
            }

            return json_encode(array("Status" => 1, "Message" => "", "Data" => $getAllVehicleResp));
        } catch(Exception $e){
            echo $e.getMessage();
        }

    }

    public function setDisplayImage(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
        $vehicleId = $Input['vehicle_id'];

        if($request->file('car_image') != null){
            $path = $request->file('car_image')->store('VehicleImages');
            Vehicle::where('id', $vehicleId)
                ->where('company_id',session("CompanyLinkID"))
                ->update([
                    'car_image' => $path
                ]
            );

            return json_encode(array("Status" =>  1, "Message" => "Vehicle pic changed successfully"));
        } else {
            return json_encode(array("Status" =>  0, "Message" => "Vehicle pic fail to change"));
        }
    }

    public function setVehicleStatus(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
        $vehicleId = $Input['vehicle_id'];
        $status = $Input['status'];

        Vehicle::where('id', $vehicleId)
            ->where('company_id',session("CompanyLinkID"))
            ->update([
                'status' => $status
            ]);

        return json_encode(array("Status" =>  1, "Message" => "Vehicle status updated successfully"));
    }

    public function uploadFiles(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        // Log::debug(sizeof($request->file('files'))); //just check what is there.. 
        Log::debug($Input); //just check what is there.. 

        $responseData = array();
        $filetype = $Input['type'];
        $vehicleId = $Input['vehicle_id'];

        if($request->file('files') && sizeof($request->file('files')) > 0){
            for($i = 0; $i < sizeof($request->file('files')); $i++ ){
                $VehicleImages = new VehicleImages();
                $VehicleImages->vehicle_id = $vehicleId;
                $VehicleImages->company_id = session("CompanyLinkID");
                $VehicleImages->type = $filetype;

                $path = $request->file('files')[$i]->store('VehicleImages');
                $VehicleImages->link = $path;
                $VehicleImages->save();
                
                //add to response
                if (!isset($responseData[$filetype])){
                    $responseData[$filetype] = [];
                }
                $img_details = array("id" => $VehicleImages->id, "link" => $VehicleImages->link);
                array_push($responseData[$filetype],$img_details);
            }
        }    

        return json_encode(array("Status" =>  1, "Message" => "files updated successfully", "Data" => $responseData));
    }

    public function deleteFile(Request $request){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Input = $request->all();
        Log::debug($Input); //just check what is there.. 
    
        $vehicleImg = VehicleImages::where("company_id", session("CompanyLinkID"))
                        ->where('vehicle_id',$Input['vehicle_id'])
                        ->where('id',$Input['image_id'])
                        ->delete();

        return json_encode(array("Status" =>  1, "Message" => "file deleted successfully"));
    }

}
