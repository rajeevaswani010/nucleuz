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
use App\Models\Product;
use App\Models\Admin;
use App\Models\User;
use App\Models\Subscription;
use DB;

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

        
        // $Data = License::latest()->get();
        $Data=DB::table('admin')->join('ls_licenses','ls_licenses.user_id','=','admin.admin_id')->get();
        // echo '<pre>';print_r($Data);echo '</pre>';die();
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

        $products = Product::where("status",'active')->get();
        $AllCompany = Office::orderBy("name")->get();
        $ActiveAction = "license";

        return view('license.add', compact("ActiveAction", "AllCompany",'products'));
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
        // echo '<pre>';print_r($Input);echo '</pre>';die();
        $v = \Validator::make($request->all(),[
            'email' => 'required|unique:admin|email',
        ]);

        if($v->fails()){
            Session::flash('Danger', $v->errors()->first());
            return redirect()->back()->withInput();
        }else{
            $Password = Str::random($strlentgh = 16);
           

            $AdminObj = new Admin();
            $AdminObj->name = $Input["conact_name"];
            $AdminObj->link_id = 0;
            $AdminObj->company_id = $Input["company_id"];
            $AdminObj->email = $Input["email"];
            $AdminObj->mobile = $Input["mobile"];
            $AdminObj->user_type = $Input["user_type"];
            $AdminObj->admin_password = Hash::make($Password);
            if($Input["user_type"] == "1"){
                $AdminObj->role = 2;
            }else{
                $AdminObj->role = 3;
            }
            // $AdminObj->role = $Input["role"];
            $AdminObj->save();


            //Create user license 
            $user_id=$AdminObj->admin_id;
            $created_by=session("AdminID");
            $domain="nucleuz.app";
            $license_key=(string) Str::uuid();
            $status="active";//('active', 'inactive', 'suspended')
            $expiry_date = date("Y-m-d h:i:s", strtotime("+".$Input["validay"]." days"));
            $is_trial=0;
            $is_lifetime=0;
            $total_employee=isset($Input["total_employee"]) ? $Input["total_employee"] : 0;
            $LicenseObj = new License();
            $LicenseObj->user_id=$user_id;
            $LicenseObj->created_by=$created_by;
            $LicenseObj->domain=$domain;
            $LicenseObj->license_key=$Input["license_key"];
            $LicenseObj->status=$Input["status"];
            $LicenseObj->total_employee=$total_employee;
            $LicenseObj->expiration_date=$expiry_date;
            $LicenseObj->license_module=$Input["role"];
            $LicenseObj->is_trial=$is_trial;
            $LicenseObj->is_lifetime=$is_lifetime;
            $LicenseObj->save();

            //Link a company with user license key
            $Licenseid=$LicenseObj->id;
            $adminUpdateObj = Admin::find($user_id);
            $adminUpdateObj->link_id=$Licenseid;
            $adminUpdateObj->save();

            // $Office = License::create($Input);
            $SubObj = new Subscription();
            // $SubObj->company_id = $Office->id;
            $SubObj->company_id=$Licenseid;
            $SubObj->validity = $Input["validay"];
            $SubObj->start_date = date("Y-m-d");
            $SubObj->end_date = $expiry_date;
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
        $products = Product::where("status",'active')->get();
        // echo '<pre>';print_r($Data);echo '<pre>';
        $Subscription = Subscription::where("company_id", $id)->latest()->get();
        $AllCompany = Office::orderBy("name")->get();
        
        $ActiveAction = "license";
        return view('license.edit', compact("Data", "ActiveAction", "Subscription", "AllCompany","products"));
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
        $total_employee=isset($Input["total_employee"]) ? $Input["total_employee"] : 0;
        $LicenseObj=License::find($id);
        

        // $LicenseArr=License::where('id', $id)->first();
        $AdminObj = Admin::find($LicenseObj->user_id);
        $AdminObj->name = $Input["conact_name"];
        $AdminObj->company_id = $Input["company_id"];
        // $AdminObj->email = $Input["email"];
        $AdminObj->mobile = $Input["mobile"];
        $AdminObj->user_type = $Input["user_type"];

        $LicenseObj->license_key=$Input["license_key"];
        $LicenseObj->status=$Input["status"];

        if($Input["user_type"] == "1"){
            $AdminObj->role = 2;
            $LicenseObj->total_employee=$total_employee;
             
        }else{
            $AdminObj->role = 3;
        }
        $LicenseObj->save();
        $AdminObj->save();
        // unset($Input["_method"]);
        // unset($Input["_token"]);
        // License::where('id', $id)->update($Input);
        // Admin::where('id', $id)->update([
        //     'name'=>$Input[''],
        // ]);
        return redirect("license");
    }

    public function UpdateSubscription(Request $request){
        $ExpiryDate = date("Y-m-d", strtotime("+".$request->validity." days", strtotime($request->start_date)));
        $Office = License::find($request->OfficeID);
        $Office->expiration_date = $ExpiryDate;

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
