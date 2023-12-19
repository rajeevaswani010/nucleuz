<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;
use Mail;
use Log;

use App\Models\BookingInvite;
use App\Models\User;
use App\Models\Office;

class BookingInviteController extends Controller
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
        
        $Data = BookingInvite::where("company_id", session("CompanyLinkID"))->where("user_id", session("AdminID"))->latest()->get();

        if($request->from_date != ""){
            $Data = $Data->where("created_at", ">=", $request->from_date." 00:00:00");
        }

        if($request->to_date != ""){
            $Data = $Data->where("created_at", "<=", $request->to_date." 23:59:59");
        }

        if($request->status != ""){
            $Data = $Data->where("status", $request->status);
        }

        if($request->status != ""){
            $Data = $Data->where("status", $request->status);
        }


        $ActiveAction = "booking-invite";
        return view('booking-invite.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "booking-invite";
        return view('booking-invite.add', compact("ActiveAction"));
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

        $Input["user_id"] = session("AdminID");
        $Office = BookingInvite::create($Input);
        $Office->link = URL("CustomerRegister")."/".base64_encode($Office->id."#".$Input["email"]);
        $Office->save();
        
        $Input["link"] = $Office->link;

        $data = array("Name" => $Input["name"], "Link" => $Input["link"]);
        $CompanyName = Office::find(session("CompanyLinkID"))->name;
        Mail::send("EmailTemplates.BookingInvite", $data, function ($m) use($Input, $CompanyName){
            $m->from("no-reply@nucleuz.app", $CompanyName);
            $m->to($Input['email'])->subject("Invite for Car Booking");
        });

        return redirect("booking-invite");
    }

    public function add(Request $request){
        try {
            if(session("AdminID") == ""){
                return redirect("/");
            }
    
            $Input = $request->all();

            // echo '<pre>';print_r($Input);echo '</pre>';die();

            $Input["user_id"] = session("AdminID");
            $Input["company_id"] = session("CompanyLinkID");
            $Input["link"] = URL("CustomerRegister")."/".base64_encode($Input["email"]);;
            $Office = BookingInvite::create($Input);
            $Office->link = URL("CustomerRegister")."/".base64_encode($Office->id."#".$Input["email"]);
            $Office->save();

            $Input["link"] = $Office->link;

            $data = array("Name" => $Input["name"], "Link" => $Input["link"]);
            $CompanyName = Office::find(session("CompanyLinkID"))->name;
            Mail::send("EmailTemplates.BookingInvite", $data, function ($m) use($Input, $CompanyName){
                $m->from("no-reply@nucleuz.app", $CompanyName);
                $m->to($Input['email'])->subject("Invite for Car Booking");
            });
            $response = array("status"=>"success");

            return json_encode($response);
        } catch(Exception $e){
            echo $e.getMessage();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        try {

            if(session("AdminID") == ""){
                return redirect("/");
            }
    
            $Input = $request->all();
            BookingInvite::find($Input["id"])->delete();
            $response = array("status"=>"success");    
        } catch (Exception $e){
            $response = array("status"=>"Error");
        }

        return json_encode($response);
    }
}
