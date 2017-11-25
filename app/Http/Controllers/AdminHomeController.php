<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Session;
use DB;


class AdminHomeController extends Controller
{
     public function adminHome()
     {
     	return view('admin.home'); 
     }
}

