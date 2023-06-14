<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Excel;

use App\Models\Brand;
use App\Import\BrandImport;

class BrandController extends Controller
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
        
        $Data = Brand::latest()->get();
        $ActiveAction = "brand";
        return view('brand.view', compact("Data", "ActiveAction"));
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

        $ActiveAction = "brand";
        return view('brand.add', compact("ActiveAction"));
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
        $Input["name"] = ucfirst($Input["name"]);

        $request->validate([
            'name' => 'required|unique:brands'
            ],
            [ 'name.unique'      => 'Sorry, This Brand Name Is Already Used. Please Try With Different One, Thank You.']);

        Brand::create($Input);
        return redirect("brand");
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
        
        $Data = Brand::find($id);
        
        $ActiveAction = "brand";
        return view('brand.edit', compact("Data", "ActiveAction"));
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
        
        Brand::where('id', $id)->update($Input);
        return redirect("brand");
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
        
        Brand::find($id)->delete();
        return redirect("brand");
    }

    public function Import(Request $request){
        $path = $request->file('ExcelFile')->store('ExcelFile');
        Excel::import(new BrandImport, $path);
        return redirect()->back();
    }
}
