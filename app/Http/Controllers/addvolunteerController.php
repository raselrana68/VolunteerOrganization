<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Session;
use DB;


class addvolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.addvolunteer'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
              // 'password'  =>  'required|min:6',
              // 'conpassword'  =>  'required|min:6 | same:password',

            ]);
        $profile = new Profile();
        $user  = new User();
        $profile->fullname = $request->fullname;
        $profile->email    = $request->email;
        $user->username = $request->username;
        $user->password = $request->username;
        $user->type = "User";

        date_default_timezone_set ('Asia/Dhaka');
        $user->lastLogin = date("Y-m-d H:i:s");

        $profile->save();
        $user->save();
        Session()->flash('Success', "Registration Created Successfully");
       return redirect()->route('userlist');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
