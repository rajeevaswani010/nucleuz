<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;
use Mail;

use App\Models\BookingInvite;
use App\Models\User;

class BookingInviteController extends Controller
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
        
        $Data = BookingInvite::where("company_id", session("CompanyLinkID"))->where("user_id", session("AdminID"))->latest()->get();
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

        $Input["link"] = URL("CustomerRegister")."/".base64_encode($Input["email"]);
        $Input["user_id"] = session("AdminID");
        $Input["company_id"] = session("CompanyLinkID");
        $Office = BookingInvite::create($Input);

        $data = array("Name" => $Input["name"], "Link" => $Input["link"]);
        Mail::send("EmailTemplates.BookingInvite", $data, function ($m) use($Input){
            $m->from("no-reply@nucleuz.app", "Nucleuz");
            $m->to($Input['email'])->subject("Invite for Car Booking");
        });

        return redirect("booking-invite");
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
    public function destroy($id)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        BookingInvite::find($id)->delete();
        return redirect("vehicle");
    }
}
