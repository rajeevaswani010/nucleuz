<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;
use Mail;

use App\Models\Admin;
use App\Models\License;
use App\Models\Subscription;
use App\Models\Staff;
use App\Models\Notification;

class HomeController extends Controller
{
    public function ChangeLanguage($lang)
	{
		session(["Lang" => $lang]);
		Session::put('locale', $lang);
		return redirect()->back();
	}
	
	public function Login(){
	    
	    if(session("locale") == ""){
		    Session::put('locale', "en");
        }
        
        if(session("Lang") == ""){
            session(["Lang" => "en"]);
        }
        
	    // $GetLicenses = Subscription::select("company_id")->where("end_date", "<", date("Y-m-d"))->orderBy("id", "DESC")->get()->pluck("company_id")->toArray();
	    
		// foreach($GetLicenses as $GLD){
		//     $CheckExpiry = Subscription::where("end_date", ">=", date("Y-m-d"))->where("company_id", $GLD)->count();
		//     if($CheckExpiry == 0){
    	// 	    $LU = Admin::where("link_id", $GLD)->get();
    	// 	    foreach($LU as $Adm){
    	// 	        $NewAdm = $Adm::find($Adm->admin_id);
    	// 	        $NewAdm->status = 0;
    	// 	        $NewAdm->save();
    	// 	    }
		//     }
		// }
		return view('welcome');
    }
	
	public function DoLogin(Request $request){

		$CheckAdmin = Admin::where('email', $request->Username)->count();

		// echo $CheckAdmin; echo '<br />';
		// $GetAdmin = Admin::where('email', $request->Username)->first();
		// echo  '<pre>';print_r($request->input());echo '</pre>';
        // die();

		if($CheckAdmin > 0){

			
			$GetAdmin = Admin::where('email', $request->Username)->first();

			if($GetAdmin->temp_password == 1){
				// echo 'ddddd';die();
				return redirect("SetPassword/".encrypt($request->Username));
			}


			$HashedPass = $GetAdmin->admin_password;
// 			echo $request->Password;
// echo '<br />';
// echo $HashedPass;
// die();
			if(password_verify($request->Password, $HashedPass)){

				if($GetAdmin->role!=1)
				{
					$licensecount=License::where('user_id',$GetAdmin->admin_id)->count();
					if($licensecount==0){
						Session::flash('Danger', "License is not found.Please contact to admin for buying license");
						return redirect()->back();
					}

					//echo '<pre>';print_r($licenseArr);echo '</pre>';die();
					$licenseArr=License::where('user_id',$GetAdmin->admin_id)->first();
					if($licenseArr->status=='inactive'){
						Session::flash('Danger', "Your License is Inactive");
						return redirect()->back();
					}


					if($licenseArr->status=='suspended'){
						Session::flash('Danger', "Your License is Suspended");
						return redirect()->back();
					}

					if(time() > strtotime($licenseArr->expiration_date)){
						//=====update admin status====//
						$adminObj=Admin::find($GetAdmin->admin_id);
						$adminObj->status=0;
						$adminObj->save();	
						//===update license status====//
						$LicenseObj=License::find($licenseArr->id);
						$LicenseObj->status='inactive';
						$LicenseObj->save();

						Session::flash('Danger', "Your License is Expired");
						return redirect()->back();
					}
			    }

				// if($GetAdmin->status == 0){
				//     Session::flash('Danger', "License Expired");
				//     return redirect()->back();
				// }
				
				session(['AdminID' => $GetAdmin->admin_id]);
				session(['AdminRole' => $GetAdmin->role]);
				session(['CompanyLinkID' => $GetAdmin->company_id]);
				session(['AdminName' => $GetAdmin->name]);
				session(['AdminImage' => $GetAdmin->image]);
				return redirect('dashboard');
			}else{
				Session::flash('Danger', "Email or password incorrect");
				return redirect()->back();
			}
		}else{
			Session::flash('Danger', "Invalid Email");
			return redirect()->back();
		}
    }

    public function DoReset(Request $request){
    	$CheckAdmin = Admin::where('email', $request->Username)->count();
		if($CheckAdmin > 0){
			$GetAdmin = Admin::where('email', $request->Username)->first();
			
			$Email = $GetAdmin->email;
            $data = array("Name" => $GetAdmin->name, "Link" => URL('SetPassword')."/".encrypt($Email));
            Mail::send("EmailTemplates.ForgotPassword", $data, function ($m) use($Email, $GetAdmin){
                $m->from("no-reply@nucleuz.app", "Nucleuz");
                $m->to($Email)->subject("Reset Password");
            });
            Session::flash('Success', "Reset Password Link Sent to Your Email Address");
            return redirect()->back();
		}else{
			Session::flash('Danger', "Invalid Email");
			return redirect()->back();
		}
    }

    public function SetPassword(Request $request){
    	$Token = $request->token;
    	return view('SetPassword', compact("Token"));
    }

    public function DoSetPassword(Request $request){
    	$Email = decrypt($request->Token);

    	$v = \Validator::make($request->all(),[
		    'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		 ]);

    	if($v->fails()){
            Session::flash('Danger', $v->errors()->first());
	        return redirect()->back();
	    }

    	$CheckAdmin = Admin::where('email', $Email)->count();
		if($CheckAdmin > 0){
			$GetAdmin = Admin::where('email', $Email)->first();
			$GetAdmin->admin_password = Hash::make($request->password);
			$GetAdmin->temp_password = 0;
			$GetAdmin->save();
            return redirect('/');
		}else{
			Session::flash('Danger', "Invalid Email");
			return redirect()->back();
		}
    }

    public function ChangePassword(){
        if(session("AdminID") == ""){
            return redirect("SuperWebAdmin");
        }
        
		$Message = "";
		$GetData = Admin::find(session("AdminID"));
		$Mobile = "";

		if(session("AdminRole") == 2){
			$License = License::find($GetData->link_id);
			@$Mobile = $License->mobile;
		}

		if(session("AdminRole") == 3){
			$License = Staff::find($GetData->link_id);
			@$Mobile = $License->mobile;
		}
		
		$ActiveAction = "";
		$data = compact("Message", "GetData", "Mobile", "ActiveAction");
		return view('ChangePassword', $data);
    }
	
	public function SavePassword(Request $request){
	    if(session("AdminID") == ""){
            return redirect("SuperWebAdmin");
        }
        
		$GetAdmin = Admin::find(session("AdminID"));
		$HashedPass = $GetAdmin->admin_password;
		
		if($request->file('UserImage') != null){
            $path = $request->file('UserImage')->store('ProfileImages');
            $GetAdmin->image = $path;
            session(['AdminImage' => $path]);
            $GetAdmin->save();
        }
        
        if(isset($request->OldPassword) && $request->OldPassword != ""){
            $v = \Validator::make($request->all(),[
    		    'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    		 ]);
    
        	if($v->fails()){
                Session::flash('Danger', $v->errors()->first());
    	        return redirect()->back();
    	    }
    	    
    		if(password_verify($request->OldPassword, $HashedPass)){
    			$AdminDAta = Admin::find(session("AdminID"));
    			$AdminDAta->admin_password = Hash::make($request->password);
    			$AdminDAta->save();
    
    			$GetData = Admin::find(session("AdminID"));
    			if(session("AdminRole") == 2){
    				$License = License::find($GetData->link_id);
    				$License->mobile = $request->mobile;
    				$License->save();
    			}
    
    			if(session("AdminRole") == 3){
    				$License = Staff::find($GetData->link_id);
    				$License->mobile = $request->mobile;
    				$License->save();
    			}
    		}else{
    		    Session::flash('Danger', "Invalid Old Password");
    	        return redirect()->back();
    		}
        }
        
        Session::flash('Success', "Data Updated Successfully");
        return redirect()->back();
    }
    
    public function ReadNotification(Request $request){
        $Noti = Notification::find($request->id);
        $Noti->status = 1;
        $Noti->save();
    }

    public function Logout(){
    	session()->flush();
		return redirect('/');
    }
}