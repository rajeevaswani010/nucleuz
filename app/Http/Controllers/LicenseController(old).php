<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;

use App\Models\Office;
use App\Models\License;
use App\Models\Admin;
use App\Models\Subscription;

class LicenseController extends Controller
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
        
        $Data = License::latest()->get();
        $ActiveAction = "license";
        return view('license.view', compact("Data", "ActiveAction"));
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

        $AllCompany = Office::orderBy("name")->get();
        $ActiveAction = "license";
        return view('license.add', compact("ActiveAction", "AllCompany"));
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

        $v = \Validator::make($request->all(),[
            'email' => 'required|unique:admin|email',
        ]);

        if($v->fails()){
            Session::flash('Danger', $v->errors()->first());
            return redirect()->back()->withInput();
        }else{
            $Password = Str::random($strlentgh = 16);
            $Input["expiry_date"] = date("Y-m-d", strtotime("+".$Input["validay"]." days"));
            $Office = License::create($Input);

            $AdminObj = new Admin();
            $AdminObj->name = $Input["conact_name"];
            $AdminObj->link_id = $Office->id;
            $AdminObj->company_id = $Input["company_id"];
            $AdminObj->email = $Input["email"];
            $AdminObj->admin_password = Hash::make($Password);
            if($Input["user_type"] == "1"){
                $AdminObj->role = 2;
            }else{
                $AdminObj->role = 3;
            }
            $AdminObj->save();

            $SubObj = new Subscription();
            $SubObj->company_id = $Office->id;
            $SubObj->validity = $Input["validay"];
            $SubObj->start_date = date("Y-m-d");
            $SubObj->end_date = $Input["expiry_date"];
            $SubObj->save();

            $Link = URL("login");

            $data = array("Name" => $Input["conact_name"], "Email" => $Input["email"], "Password" => $Password, "Link" => $Link);
            Mail::send("EmailTemplates.Registration", $data, function ($m) use($Input){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($Input['email'])->subject("Login Detail for Nucleuz");
            });
            return redirect("license");
        }
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
        
        $Data = License::find($id);
        $Subscription = Subscription::where("company_id", $id)->latest()->get();
        $AllCompany = Office::orderBy("name")->get();
        
        $ActiveAction = "license";
        return view('license.edit', compact("Data", "ActiveAction", "Subscription", "AllCompany"));
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
        License::where('id', $id)->update($Input);
        return redirect("license");
    }

    public function UpdateSubscription(Request $request){
        $ExpiryDate = date("Y-m-d", strtotime("+".$request->validity." days", strtotime($request->start_date)));
        $Office = License::find($request->OfficeID);
        $Office->expiry_date = $ExpiryDate;

        $SubObj = new Subscription();
        $SubObj->company_id = $request->OfficeID;
        $SubObj->validity = $request->validity;
        $SubObj->start_date = $request->start_date;
        $SubObj->end_date = $ExpiryDate;
        $SubObj->save();
        
        $getAdmin = Admin::where("link_id", $request->OfficeID)->get();
        foreach($getAdmin as $adm){
            $ad = Admin::find($adm->admin_id);
            $ad->status = 1;
            $ad->save();
        }

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
        
        License::find($id)->delete();
        return redirect("license");
    }
}
