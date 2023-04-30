<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Session;
use Mail;

use App\Models\Product;
use App\Models\Admin;
use App\Models\Subscription;

class ProductController extends Controller
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
        
        $Data = Product::latest()->get();
        $ActiveAction = "product";
        return view('product.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "product";
        return view('product.add', compact("ActiveAction"));
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
        $Office = Product::create($Input);
        return redirect("product");
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
        
        // $Data = Product::find($id);
        $Data = Product::where("id", $id)->first();
        // echo '<pre>';print_r($Data);echo '</pre>';die();
        
        $ActiveAction = "product";
        return view('product.edit', compact("Data", "ActiveAction"));
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
        Product::where('id', $id)->update($Input);
        return redirect("product");
    }

    // public function UpdateSubscription(Request $request){
    //     $ExpiryDate = date("Y-m-d", strtotime("+".$request->validity." days", strtotime($request->start_date)));
    //     $Office = Office::find($request->OfficeID);
    //     $Office->expiry_date = $ExpiryDate;

    //     $SubObj = new Subscription();
    //     $SubObj->company_id = $request->OfficeID;
    //     $SubObj->validity = $request->validity;
    //     $SubObj->start_date = $request->start_date;
    //     $SubObj->end_date = $ExpiryDate;
    //     $SubObj->save();

    //     return redirect()->back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function delete($id)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        Product::find($id)->delete();
        return redirect("product");
    }


    public function destroy($id)
    {
        if(session("AdminID") == ""){
            return redirect("/");
        }
        
        Product::find($id)->delete();
        return redirect("product");
    }
}
