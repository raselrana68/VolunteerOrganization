<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Event;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
     public function userReport()
     {
     	$admincount = User::where('type','Admin')->count();
     	$usercount = User::where('type','User')->count();

          $statusPending = Event::where('status','Pending')->count();
          $statusCompleted = Event::where('status','Completed')->count();
          $statusCanceled = Event::where('status','Canceled')->count();

     	$userLastLogin = User::all();
          $arr = [];
          $threeToSix = $sixToNinth = $nintoTwleve = $moreThenTwelve = 0;

     	foreach ($userLastLogin as $date) {

               $to = Carbon::createFromFormat('Y-m-d H:s:i', $date->lastLogin);
               $from =Carbon::now();
               $month = $to->diffInMonths($from);

               if(($month <= 6) && ($month >=3) ){
                 $threeToSix++;
               }elseif (($month <= 9) && ($month >6) ) {
                    $sixToNinth++;
               }elseif (($month <= 12) && ($month >9) ) {
                    $nintoTwleve++;
               }elseif (($month > 12)) {
                    $moreThenTwelve++;
               }
     	} 

          $arr[0] = $threeToSix; 
          $arr[1] = $sixToNinth; 
          $arr[2] = $nintoTwleve; 
          $arr[3] = $moreThenTwelve;
          
      	return view('admin.report')
				->with('admincount',$admincount)
				->with('usercount',$usercount)
				->with('arr',$arr)
                    ->with('statusPending',$statusPending)
                    ->with('statusCompleted',$statusCompleted)
                    ->with('statusCanceled',$statusCanceled);
     }
}
