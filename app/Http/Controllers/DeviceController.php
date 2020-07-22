<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Device;
class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $s = $request->s;

        $devices = Device::orderBy('id','desc')->search($s)->paginate(100);

        return view('pages.device.list',compact('devices','start_date','end_date','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $device = new Device;
        $device->name = $request->name;
        $device->imei = $request->imei;
        $device->save();
        return redirect()->route('Device.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);
        $locations = Data::where('imei',$device->imei)->where('lat','!=',' 0000.0000')->orderBy('id','desc')->limit(50)->get();
        $datas = Data::where('imei',$device->imei)->where('lat','!=','0000.0000')->orderBy('id','desc')->paginate(10);

        return view('pages.device.index',compact('datas','device','locations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
       $device = Device::find($id);
       return view('pages.device.edit',compact('device'));
    
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
        $device = Device::find($id);
        $device->name = $request->name;
        $device->imei = $request->imei;
        $device->save();

        return redirect()->route('Device.index');
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();
        return redirect()->route('Device.index');
    }

    public function deletedata($id){
        $data = Data::find($id);
        $data->delete();
        return redirect()->back();
    }
}
