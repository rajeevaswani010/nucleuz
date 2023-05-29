<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Session;
use Excel;

use App\Export\PricingExport;
use App\Import\PricingImport;
use App\Models\Pricing;

class PricingController extends Controller
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
        
        $Data = Pricing::where("company_id", session("CompanyLinkID"))->latest()->get();
        $ActiveAction = "pricing";
        return view('pricing.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "pricing";
        return view('pricing.add', compact("ActiveAction"));
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
        $Office = Pricing::create($Input);
        return redirect("pricing");
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
        
        $Data = Pricing::find($id);
        // echo '<pre>';print_r($Data); echo '</pre>';die();

        $ActiveAction = "pricing";
        return view('pricing.edit', compact("Data", "ActiveAction"));
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
        Pricing::where('id', $id)->update($Input);
        return redirect("pricing");
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
        
        Pricing::find($id)->delete();
        return redirect("pricing");
    }

    public function Export(){
        $Data = Pricing::where("company_id", session("CompanyLinkID"))->latest()->get();
        return Excel::download(new PricingExport($Data), 'pricing.xlsx');
    }

    public function Import(Request $request){
        $path = $request->file('ExcelFile')->store('ExcelFile');
        Excel::import(new PricingImport, $path);
        return redirect()->back();
    }

}
