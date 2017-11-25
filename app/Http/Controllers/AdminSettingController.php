<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

class AdminSettingController extends Controller
{
   public function settingPageLoad($id)
   {
   	    $userInfo = User::find($id);
        return view('admin.setting')->with('userInfo',$userInfo);
   }



   public function updateSett(Request $request,$id)
   {

     $this->validate($request,[
            'oldPassword' =>'required',
            'newPassword' => 'bail | required | min:6',
            'retypePassword' => 'bail | required | min:6 | same:newPassword',
            ]);
         $userPassword = DB::table('users')
                         ->where('userId',$id)
                         ->value('password');
        if($userPassword != $request->oldPassword)
        {
            Session()->flash('message', "Your Old password Input Is not correct");
            return redirect()->back();
        }
        $user = User::find($id);
        $user->password = $request->newPassword;
         Session()->flash('message', "Passoword Change Successfully");
        $user->save();
        return redirect()->route('adminHome',$user->userId);
   }


}
