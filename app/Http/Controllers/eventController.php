<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\User;
use App\Event;
use Session;
use DB;


class eventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
    }


    public function newEvent()
    {
        return view('admin.newevent'); 
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
              'eventname' => 'bail | required',
              'eventdate' => 'bail  | required | date | after:today',
              'venue' => 'bail | required ',
              'eventdetails'=> 'bail  | required | min:20 | max:400',
              ]);
        
        $event = new Event();

        $event->eventname = $request->eventname;
        $event->eventdetails = $request->eventdetails;
        $event->hostadmin =Session::get('userName');
        $event->eventdate = $request->eventdate;
        $event->venue=$request->venue;
        $event->status="Pending";
       
       //return $event->hostadmin;
         

        date_default_timezone_set ('Asia/Dhaka');
        $event->created_at = date("Y-m-d H:i:s");

        $event->save();
        Session()->flash('SuccessMessage', "EVENT Created Successfully");
       return redirect()->route('eventlist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function acceptedeventListUser()
    {   
        $myId=Session::get('userName');
        $status=2;

        $eventList=DB::table('requestevents')
                    ->join('events','events.eventId','=','requestevents.eventId')
                    ->where('username',$myId)
                    ->get();

         // return dd($eventList);

        return view('user.viewAllEvents')->with('eventList',$eventList);
    }
  
     public function eventListUser()
    {
        $eventList=Event::all();
        return view('user.eventlist')
                    ->with('eventList',$eventList);
    }
        
   
    public function eventListAdmin()
    {
        $eventList=Event::all();
        return view('admin.eventlist')
                    ->with('eventList',$eventList);
    }
    
    public function userEventDetails($id)
    {
        $eventList=Event::find($id);
        return view('user.eventdetails')
                    ->with('eventList',$eventList);
    }

    public function eventDetails($id)
    {
        $eventList=Event::find($id);
        return view('admin.eventdetails')
                    ->with('eventList',$eventList);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

         
         $eventall = Event::find($id);

         return view('admin.eventedit')
                ->with('eventall',$eventall);
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
             'eventname' => 'bail | required',
              'eventdate' => 'bail  | required | date | after:today',
              'venue' => 'bail | required ',
            'eventdetails'=> 'bail  | required | min:20 | max:400',
            ]);

        $eventUpdate = Event::find($id);
        

        $eventUpdate->eventname = $request->eventname;
        $eventUpdate->eventdate = $request->eventdate;
        $eventUpdate->eventdetails = $request->eventdetails;
        $eventUpdate->venue = $request->venue;
        
        if($eventUpdate->status == $request->status){
            Session()->flash('Error', "Your Selected User type Already Defined");
            return redirect()->back();
        }
        $eventUpdate->status = $request->status;
        
        date_default_timezone_set ('Asia/Dhaka');
        $eventUpdate->updated_at = date("Y-m-d H:i:s");

        $eventUpdate->save();
        Session()->flash('UpdateSuccessMessage',"Event Update Successfully");
        return redirect()->route('eventDetails',$eventUpdate->eventId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Event::find($id)->delete();
        Session()->flash('Success', "Deleted Successfully");
        return redirect()->back();
    }
}
