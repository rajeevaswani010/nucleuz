<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;

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
        
        $ActiveAction = "office";
        return view('office.edit', compact("Data", "ActiveAction", "Subscription"));
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
        Office::where('id', $id)->update($Input);
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
}
