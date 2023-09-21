<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;
use Log;

use App\Models\Office;
use App\Models\Admin;
use App\Models\Subscription;

class OfficeController extends Controller
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
        
        $Data = Office::latest()->get();
        $ActiveAction = "office";
        return view('office.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "office";
        return view('office.add', compact("ActiveAction"));
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
            'name' => 'required|unique:offices'
            ],
            [ 'name.unique'      => 'Sorry, This Company Name Is Already Used. Please Try With Different One, Thank You.']);

        unset($Input["lang"]);
        $Office = Office::create($Input);
        return redirect("office");
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
        
        $Data = Office::find($id);
        $Subscription = Subscription::where("company_id", $id)->latest()->get();
        Log::debug("Data - ". $Data);

        $ActiveAction = "office";
        return view('office.edit', compact("Data", "ActiveAction", "Subscription"));
    }

    public function getSettings()
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $Data = Office::find(session("CompanyLinkID"));

        $ActiveAction = "office";
        return view('office.settings', compact("Data", "ActiveAction"));
    }

    public function updateSettings(Request $request)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        $Input = $request->all();
        $Input["id"] = session("CompanyLinkID");
        // echo '<pre>';print_r($Input);echo '</pre>';die();
        unset($Input["_method"]);
        unset($Input["_token"]);
        unset($Input["lang"]);

        if($request->file('logo') != null){
            $path = $request->file('logo')->store('officeImages');
            $Input['logo'] = $path;
        }
        if($request->file('page') != null){
            $path = $request->file('page')->store('pageImages');
            $Input['page'] = $path;
        }
        //Log::debug($Input);
        $office = Office::where('id',session("CompanyLinkID"))->update($Input);
        return redirect("settings");
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
        // echo '<pre>';print_r($Input);echo '</pre>';die();
        unset($Input["_method"]);
        unset($Input["_token"]);
        unset($Input["lang"]);

        if($request->file('logo') != null){
            $path = $request->file('logo')->store('officeImages');
            $Input['logo'] = $path;
        }
        if($request->file('page') != null){
            $path = $request->file('page')->store('pageImages');
            $Input['page'] = $path;
        }
        //Log::debug($Input);
        $office = Office::where('id', $id)->update($Input);
        return redirect("office");
    }

    public function UpdateSubscription(Request $request){
        $ExpiryDate = date("Y-m-d", strtotime("+".$request->validity." days", strtotime($request->start_date)));
        $Office = Office::find($request->OfficeID);
        $Office->expiry_date = $ExpiryDate;

        $SubObj = new Subscription();
        $SubObj->company_id = $request->OfficeID;
        $SubObj->validity = $request->validity;
        $SubObj->start_date = $request->start_date;
        $SubObj->end_date = $ExpiryDate;
        $SubObj->save();

        return redirect()->back();
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
        
        Office::find($id)->delete();
        return redirect("office");
    }

    public function getCurrentSettingsAsJson(){
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        $data = Office::find(session("CompanyLinkID"));
        $ActiveAction = "office";        
        Log::debug($data);
        return json_encode(array("status" => 1, "Message" => "", "Data" => $data));
    }
}
