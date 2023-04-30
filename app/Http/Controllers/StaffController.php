<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;

use App\Models\Office;
use App\Models\Staff;
use App\Models\Admin;
use App\Models\Subscription;

class StaffController extends Controller
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

        // $adminArr=Admin::where('admin_id',session("AdminID"))->first();
        // echo '<pre>';print_r($adminArr);echo '</pre>';die();

        // if($adminArr->role==2){
        //     $Data = Staff::latest()->get();
        // }
        // else{
            $Data = Staff::where("company_id", session("CompanyLinkID"))->latest()->get();
        // }
        
        
        $ActiveAction = "staff";
        return view('staff.view', compact("Data", "ActiveAction"));
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

        $Offices = Office::get();
        $ActiveAction = "staff";
        return view('staff.add', compact("ActiveAction", "Offices"));
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
            $Input["company_id"] = session("CompanyLinkID");
            $Office = Staff::create($Input);
            $Password = Str::random($strlentgh = 16);
            $AdminObj = new Admin();
            $AdminObj->name = $Input["name"];
            $AdminObj->link_id = $Office->id;
            $AdminObj->company_id = $Input["company_id"];
            $AdminObj->email = $Input["email"];
            $AdminObj->mobile = $Input["mobile"];
            $AdminObj->admin_password = Hash::make($Password);
            $AdminObj->role = 3;
            $AdminObj->save();

            $data = array("Name" => $Input["name"], "Email" => $Input["email"], "Password" => $Password, "Link" => URL("/"));
            Mail::send("EmailTemplates.Registration", $data, function ($m) use($Input){
                $m->from("no-reply@nucleuz.com", "Nucleuz");
                $m->to($Input['email'])->subject("Login Detail for Nucleuz");
            });

            return redirect("staff");
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
        
        $Data = Staff::find($id);
        $ActiveAction = "staff";
        return view('staff.edit', compact("Data", "ActiveAction"));
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
        Staff::where('id', $id)->update($Input);
        return redirect("staff");
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
        
        Staff::find($id)->delete();
        return redirect("staff");
    }
}
