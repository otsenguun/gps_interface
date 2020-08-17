<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();


Route::group(['middleware' => ['auth']], function () {

	Route::get('/', 'DeviceController@main')->name('devices');

	Route::get('/home', 'DeviceController@main')->name('home');

	Route::resource('Device','DeviceController');
	Route::resource('User','UserController');

	Route::get('delete_data/{id}','DeviceController@deletedata');


	Route::get('/call_main','DeviceController@main_ajax');
	
});


