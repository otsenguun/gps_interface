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


Route::get('/', 'HomeController@welcome');

Route::group(['middleware' => ['auth']], function () {


        Route::get('/gpsDashboard', 'HomeController@index');
        Route::get('/showDevices', 'DeviceController@main');
        Route::get('/listDevices', 'DeviceController@indexorg');

        Route::get('/ShowInvoices', 'HomeController@index');
        Route::get('/getlastdistace','DeviceController@getlastdistace');
        Route::get('/Device/show/{id}','DeviceController@show');


        Route::group(['middleware' => ['admin']], function () {
            Route::get('/home', 'DeviceController@main')->name('home');

            Route::resource('Device','DeviceController');
            Route::resource('User','UserController');

            Route::get('delete_data/{id}','DeviceController@deletedata');


            Route::get('/call_main','DeviceController@main_ajax');
            Route::get('CustomerAddUser/{id}','CustomerController@createUser');
            Route::get('/RawData','DeviceController@showRaw');
            Route::post('Customer/User/Create','CustomerController@storeUser');

            Route::resource('Customer','CustomerController');
            Route::resource('Invoice','InvoiceController');

        });

});


