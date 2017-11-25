<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Session;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('register'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
              'fullname' => 'bail | required | min:4',
              'email'    => 'bail  | required | unique:profiles,email',
              'username' => 'bail | required | min:4',
              'password'  =>  'required|min:4',
              'conpassword'  =>  'required|min:4 | same:password',

            ]);
        
        $profile = new Profile();
        $user  = new User();
        $profile->fullname = $request->fullname;
        $profile->email    = $request->email;
        
        $user->username = $request->username;
        $user->password = $request->password;
        $user->type = "User";

        date_default_timezone_set ('Asia/Dhaka');
        $user->lastLogin = date("Y-m-d H:i:s");

        $profile->save();
        $user->save();
        Session()->flash('SuccessMessage', "Registration Created Successfully");
       return redirect()->route('loginView');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $userInfoUser     = User::find($id);
       $userInfoProfile = Profile::find($id);

       return view('user.profile')
              ->with('userInfoUser',$userInfoUser)
              ->with('userInfoProfile',$userInfoProfile); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userProfile = Profile::find($id);

        return view('user.edit')->with('userProfile',$userProfile);
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
        $this->validate($request,[
             'fullname' => 'bail | required | min:4',
              'email'   => 'bail  | required ',
            ]);
        $user = Profile::find($id);

        $user->fullname = $request->fullname;
        $user->email = $request->email;
    
        $user->save();
        Session()->flash('UpdateSuccessMessage',"Profile Update Successfully");
        return redirect()->route('user.show',$user->userId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
