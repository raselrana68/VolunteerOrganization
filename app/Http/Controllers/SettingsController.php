<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Event;


class SettingsController extends Controller
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
         
    }

    public function contact()
    {
         return view('user.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $userInfo = User::find($id);

        return view('user.settings')->with('userInfo',$userInfo);
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
            'oldPassword' =>'required',
            'newPassword' => 'bail | required | min:4',
            'retypePassword' => 'bail | required | min:4 | same:newPassword',
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
