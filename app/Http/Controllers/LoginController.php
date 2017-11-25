<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Session;
 

class LoginController extends Controller
{
     public function loginPageLoad()
     {
     	return view('login');
     }
  
     public function userCheck(Request $request)
     { 
         $this->validate($request,[
              'username' => 'bail | required',
              'password'  =>  'required',
            ]);

        $user = User::where('username',$request->username)
        			  ->where('password',$request->password)
        			  ->first();
        if($user != null){
        	$userProfile = Profile::where('userId',$user->userId)
        					        ->first();

        	//LastLogin column update

        	$userLastLoginUpdate = User::find($user->userId);
        	date_default_timezone_set ('Asia/Dhaka');
        	$userLastLoginUpdate->lastLogin = date("Y-m-d H:i:s");
        	$userLastLoginUpdate->save();

            $request->session()->put('userName', $user->username);
            $request->session()->put('userFullName', $userProfile->fullname);
            $request->session()->put('userId', $userProfile->userId);
            $request->session()->put('userLastLogin', $userLastLoginUpdate->lastLogin);

            if($user->type == 'User'){

                Session()->put('userAuth','Yes');
        	   return view('user.home');
                      
            }else{
                Session()->put('adminAuth','Yes');
                return view('admin.home');
            }

        }else{
        	Session()->flash('LogoinErrorMessage', "Username And Password does not match");
        	return redirect()->back();
        }

     }

     public function userHome()
     {
     	return view('user.home');
     }

     public function logout()
     {
     	Session::flush();
     	return redirect()->route('loginView');
     }
}
