<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Profile;
use App\Event;
Use App\User;
Use App\Requestevent;

class requestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

    }

    public function AddVolunteerToEventView($id)
    {   
        //  $eventList=Event::find($id);

        //  // return dd($eventList);

        //  $userlist =Profile::all();
        // return view('admin.VolunteerAddEvent')->with('userlist',$userlist)
        //                                        ->with('eventList',$eventList);;
    }


    public function viewEventVolunteer($id)
    {   
        $eventList=Event::find($id);

        // $volunteer=Requestevent::find($id);
       $volunteerList= DB::table('requestevents')
                   ->where('eventId',$id)
                   ->get();

        // return dd($volunteerList);
    
        return view('admin.eventUserList')->with('volunteerList',$volunteerList)
                                           ->with('eventList',$eventList);
    }


     public function requestView($id)
    {   
        $eventList=Event::find($id);

        $requestList= DB::table('requestevents')
                   ->where('eventId',$id)
                   ->get();

        return view('admin.requestView')->with('requestList',$requestList)
                                         ->with('eventList',$eventList);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendRequest($id)
    {   
        $currentUserID=Session::get('userName');

        $request= DB::table('requestevents')
                          ->where('eventId',$id)
                          ->where('username',$currentUserID)
                          ->first();

        if($request!=null)

            { Session()->flash('alreadyrequested', " You have already sent Request !!!");
                return redirect()->route('usereventlist');
            }

        else

            { $eventreq = new Requestevent();

                        $eventreq->eventId = $id;
                        $eventreq->username =Session::get('userName');
                        $eventreq->statuss =1;

                        $eventreq->save();
                        Session()->flash('requestmessage', "Request sent Successfully to Join Event");
                       return redirect()->route('usereventlist');
                        
            }            
     }
        


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
    public function store(Request $request,$id)
    {
        $eventList=Event::find($id);
        $eventId=$eventList->eventId;
        
        $requestCheck= DB::table('requestevents')
                          ->where('eventId',$eventId)
                          ->get();

        return dd($requestCheck);
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
        $reqAccept=Requestevent::find($id);

        $currentUserName=Session::get('userName');

         $reqAccept->statuss=2;
            
            Session()->flash('acceptmessage', "Request accept Successfully");
            $reqAccept->save();

            return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
            Requestevent::find($id)->delete();
            Session()->flash('deletedmsg', "Deleted Successfully");
            return redirect()->back();
    }
}