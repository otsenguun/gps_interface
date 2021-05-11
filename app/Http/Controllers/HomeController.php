<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Customers;
use App\User;
use App\Invoice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        if(\Auth::user()->type == 9){
            $devices = Device::count();
            $users = User::count();
        }else{
            $devices = Device::where('org_id',\Auth::user()->org_id)->count();
            $users = User::where('org_id',\Auth::user()->org_id)->count();
        }
        $false_devices =  Device::where('status',0)->count();
        $invoices = Invoice::count();
        $customers = Customers::count();

        return view('home',compact('users','devices','invoices','customers','false_devices'));
    }
}
