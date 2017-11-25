<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
	return view('index');
});

// Login
Route::get('/login','LoginController@loginPageLoad')->name('loginView');

Route::post('/user/home','LoginController@userCheck')->name('userCheck');

// Register viewLoad
Route::get('/register','UserController@create')->name('registerView');
Route::post('/register','UserController@store')->name('registerCheck');

Route::get('/logout','LoginController@logout')->name('logout');



// For User Authenticated or not
Route::group(['middleware' => 'user'], function() {
     
	Route::get('/user/home','LoginController@userHome')->name('userHome');
	
	//User Registration
	Route::resource('/user','UserController');

	// SettingController
	Route::resource('user/settings','SettingsController');
	
	Route::get('/contact','SettingsController@contact')->name('contact');
	//Event 
	Route::resource('/event','eventController');
	Route::get('userEventDetails/{id}','eventController@userEventDetails')->name('userEventDetails');
	Route::get('/usereventlist','eventController@eventListUser')->name('usereventlist');

	//Event Request
	//Route::resource('/request','requestController');
	Route::get('/request/{id}','requestController@sendRequest')->name('sendrequest');

	Route::get('/acceptevent','eventController@acceptedeventListUser')->name('acceptevent');
    
});

// admin Routes

Route::group(['middleware' => 'admin'], function() {
     
    Route::get('admin/home/','AdminHomeController@adminHome')->name('adminHome');

	Route::resource('/admin','AdminController');

	Route::get('setting/{id}','AdminSettingController@settingPageLoad')->name('adminSetting');
	Route::post('setting/{id}','AdminSettingController@updateSett')->name('updateSetting');

	Route::get('/report','ReportController@userReport')->name('userReport');

	//Event
	Route::resource('/event','eventController');
	Route::get('eventDetails/{id}','eventController@eventDetails')->name('eventDetails');

	Route::get('/eventlist/','eventController@eventListAdmin')->name('eventlist');
	Route::get('/events/newevent','eventController@newEvent')->name('newevent');
	Route::post('/createevent','eventController@store')->name('createEvent');

	Route::resource('/userlist','eventController');
	 //add volunteer by admin
	Route::get('/addvolunteer','addvolunteerController@index')->name('addVolunteerView');
	Route::post('/addvolunteer','addvolunteerController@store')->name('addvolunteer');
	Route::get('/userlist','AdminController@index')->name('userlist');

	Route::post('/searchview','AdminController@search')->name('searchview');

	//Request
	Route::resource('/request','requestController');
	Route::get('/accept/{id}','requestController@update')->name('accept');
	Route::get('/destroy/{id}','requestController@destroy')->name('destroy');
	Route::get('/requestView/{id}','requestController@requestView')->name('requestView');
	Route::get('/eventvolunteer/{id}','requestController@viewEventVolunteer')->name('eventvolunteer');

	Route::get('/addVol/{id}','requestController@AddVolunteerToEventView')->name('addVol');
	Route::get('/addVolList/{id}','requestController@store')->name('addVolList');
	


   
});
 
