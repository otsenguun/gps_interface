<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Customers;
use App\User;
use App\Invoice;
use App\Event;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function urilga()
    {

        return view('urilga');
    }
    public function listUrilga()
    {
        $list = Event::all();
        return view('urliga_result',compact("list"));
    }
    

    public function urilgaConfirm(Request $request)
    {

        $event = new Event;
        $event->name = $request->name;
        $event->phone = $request->phone;
        $event->save();

        return view('urilga_done',compact('event'));
    }

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

    public function welcome(){
        return view("home.welcome");
    }

    public function test(){
        return view("home.test");
    }

}
