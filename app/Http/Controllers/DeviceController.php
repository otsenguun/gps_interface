<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
use App\Data;
use App\Device;
use App\LastDistance;

class DeviceController extends Controller
{

    public function showRaw(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $s = $request->s;
        $datas = Data::orderBy('id','desc')->search($s)->whereBetween('datetime',[$start_date,$end_date])->paginate(100);


        return view("pages.other.gpsraw",compact('datas','start_date','end_date','s'));
    }
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
    public function indexorg(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $s = $request->s;

        $devices = Device::orderBy('id','desc')->where('org_id',\Auth::user()->org_id)->search($s)->paginate(100);

        return view('pages.device.listorg',compact('devices','start_date','end_date','s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customers::select('id','name')->get();
        return view('pages.device.create',compact('customers'));
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
        $device->org_id = $request->org_id;
        $device->phone = $request->phone;
        $device->pin_code = $request->pin_code;
        $device->status = $request->status;
        $device->driver_name = $request->driver_name;
        $device->app_driver = $request->app_driver;
        $device->tt_send_status = $request->tt_send_status;
        // $device->tt_send_date = $request->tt_send_date;
        // $device->image = $request->image;
        $device->save();

        return redirect()->route('Device.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        function calculate_date($seconds){

            $time = floor($seconds/60/60);

            $time_float = ($seconds/60/60)-$time;

            $minut = floor($time_float*60);

            $minut_float = ($time_float*60) - $minut;

            $seconds = floor($minut_float*60);

             return $time." цаг ".$minut." мин ".$seconds." сек";

        }


        $device = Device::find($id);

        if($device == ""){
            die('Мэдээлэл олдмонгүй');
        }

        if(\Auth::user()->type != 9 && \Auth::user()->org_id != $device->org_id){
            die('Хандөх эрхгүй байна');
        }


        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $start_time = $request->start_time;
        $end_time = $request->end_time;

        if($start_date == ""){
            $start_date = date('Y-m-d');
        }
        if($end_date == ""){
            $end_date = date('Y-m-d');
        }
        if($start_time == ""){
            $start_time = " 00:00:00";
        }
        if($end_time == ""){
            $end_time = " 23:59:59";
        }


        $locations = Data::select('lat','lng','datetime','speed')->where('imei',$device->imei)
        ->orderBy('id','asc')
        ->where('lng','!=','00000.0000')
        ->whereBetween('datetime',[$start_date." ".$start_time,$end_date." ".$end_time])
        ->get();
        // dd($start_date.$start_time,$end_date.$end_time);
        $datas = Data::where('imei',$device->imei)
        ->orderBy('id','desc')
         ->where('lng','!=','00000.0000')
        ->whereBetween('datetime',[$start_date." ".$start_time,$end_date." ".$end_time])
        ->paginate(500);

        $top_speed = 0;
        $avarage_speed = 0;

        $total_speed = 0;
        $total_speed_count = 0;



        $total_run_time = 0;
        $total_stop_time = 0;
        foreach($locations as $key => $data){

            $speed = 0 + $data->speed;
            if($top_speed <= $speed){
                $top_speed = $speed;
            }
            if($key == 0){
                continue;
            }

            if($speed > 0){
               $total_speed_count += 1;
               $total_speed += $speed;
               $now_seconds = strtotime($data->datetime);
               $before_seconds = strtotime($locations[$key - 1]->datetime);
               $total_run_time += ($now_seconds - $before_seconds);

            }

            if($speed == 0 && (0 + $locations[$key - 1]->speed) == 0){

               $now_seconds = strtotime($data->datetime);
               $before_seconds = strtotime($locations[$key - 1]->datetime);
               $total_stop_time += ($now_seconds - $before_seconds);

            }

        }


        // dd(calculate_date($total_run_time));

        $stop_time = calculate_date($total_stop_time);
        $run_time = calculate_date($total_run_time);
        if($total_speed == 0 && $total_speed_count == 0){
    	   $avarage_speed = 0;
    	}else{
    		$avarage_speed = ($total_speed/$total_speed_count);
    	}

        
        return view('pages.device.index',compact('datas','device','locations','start_date','end_date','start_time','end_time','top_speed','stop_time','run_time','avarage_speed'));
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
       $customers = Customers::select('id','name')->get();
       return view('pages.device.edit',compact('device','customers'));

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
        $device->org_id = $request->org_id;
        $device->phone = $request->phone;
        $device->pin_code = $request->pin_code;
        $device->status = $request->status;
        $device->driver_name = $request->driver_name;
        $device->app_driver = $request->app_driver;
        $device->tt_send_status = $request->tt_send_status;
        $device->tt_send_date = $request->tt_send_date;
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

    public function playroad($id, Request $request)
    {

        function calculate_date($seconds){

            $time = floor($seconds/60/60);

            $time_float = ($seconds/60/60)-$time;

            $minut = floor($time_float*60);

            $minut_float = ($time_float*60) - $minut;

            $seconds = floor($minut_float*60);

             return $time." цаг ".$minut." мин ".$seconds." сек";

        }


        $device = Device::find($id);

        if($device == ""){
            die('Мэдээлэл олдмонгүй');
        }

        if(\Auth::user()->type != 9 && \Auth::user()->org_id != $device->org_id){
            die('Хандөх эрхгүй байна');
        }


        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $start_time = $request->start_time;
        $end_time = $request->end_time;

        if($start_date == ""){
            $start_date = date('Y-m-d');
        }
        if($end_date == ""){
            $end_date = date('Y-m-d');
        }
        if($start_time == ""){
            $start_time = " 00:00:00";
        }
        if($end_time == ""){
            $end_time = " 23:59:59";
        }


        $locations = Data::select('lat','lng','datetime','speed')->where('imei',$device->imei)
        ->orderBy('id','asc')
        ->where('lng','!=','00000.0000')
        ->where('speed','!=','0')
        ->whereBetween('datetime',[$start_date." ".$start_time,$end_date." ".$end_time])
        ->get();
        // dd($start_date.$start_time,$end_date.$end_time);
        $datas = Data::where('imei',$device->imei)
        ->orderBy('id','desc')
         ->where('lng','!=','00000.0000')
        ->whereBetween('datetime',[$start_date." ".$start_time,$end_date." ".$end_time])
        ->paginate(500);

        $top_speed = 0;
        $avarage_speed = 0;

        $total_speed = 0;
        $total_speed_count = 0;



        $total_run_time = 0;
        $total_stop_time = 0;
        foreach($locations as $key => $data){

            $speed = 0 + $data->speed;
            if($top_speed <= $speed){
                $top_speed = $speed;
            }
            if($key == 0){
                continue;
            }

            if($speed > 0){
               $total_speed_count += 1;
               $total_speed += $speed;
               $now_seconds = strtotime($data->datetime);
               $before_seconds = strtotime($locations[$key - 1]->datetime);
               $total_run_time += ($now_seconds - $before_seconds);

            }

            if($speed == 0 && (0 + $locations[$key - 1]->speed) == 0){

               $now_seconds = strtotime($data->datetime);
               $before_seconds = strtotime($locations[$key - 1]->datetime);
               $total_stop_time += ($now_seconds - $before_seconds);

            }

        }


        // dd(calculate_date($total_run_time));

        $stop_time = calculate_date($total_stop_time);
        $run_time = calculate_date($total_run_time);
        if($total_speed == 0 && $total_speed_count == 0){
    	   $avarage_speed = 0;
    	}else{
    		$avarage_speed = ($total_speed/$total_speed_count);
    	}

        
        return view('pages.device.road_play',compact('datas','device','locations','start_date','end_date','start_time','end_time','top_speed','stop_time','run_time','avarage_speed'));
    }


    public function main(Request $request){

        if(\Auth::user()->type == 9){
            $devices = Device::select('id','name','imei')->get();
        }else{
            $devices = Device::select('id','name','imei')->where('org_id',\Auth::user()->org_id)->get();
        }
        $device_datas = [];
        $lat = "";
        $lng = "";

        foreach ($devices as $key => $value) {
            $dev_data = Data::select('lat','lng','speed')
            ->where('imei',$value->imei)
            ->where('lng','!=','00000.0000')
            ->orderBy('datetime','desc')
            ->first();
            if($dev_data != ''){
                $data = new \StdClass;
                $data->name = $value->name;
                $data->lat = $dev_data->lat;
                $data->lng = $dev_data->lng;
                $data->speed = $dev_data->speed;
                $device_datas[$value->imei] = $data;
                $lat = $dev_data->lat;
                $lng = $dev_data->lng;
            }
        }
        // dd($device_datas);
        return view('pages.main',compact('devices','device_datas','lat','lng'));

    }


    public function main_ajax(Request $request){

        $devices = $request->imeis;

        $data = [];

        foreach ($devices as $key => $value) {

            $pin = Data::select('lat','lng','speed')
            ->where('imei',$value)
            ->where('lng','!=','00000.0000')
            ->orderBy('datetime','desc')
            ->first();

            if($pin !=''){
                $data[] = $pin;
            }

        }

       return response()->json(['data' => $data]);


    }

     public function getlastdistace(Request $request){

        if(\Auth::user()->type == 9){
            $pins = LastDistance::select('lat','lng','speed','imei','datetime')
            ->where('lng','!=','00000.0000')
            ->orderBy('datetime','desc')
            ->get();


            $alldata = [];
            foreach($pins as $pin){
                $device_info = $pin->GetDevice($pin->imei);
                if($device_info !=""){
                    $data['id'] = $device_info->id;
                    $data['dev_name'] = $device_info->name;
                }else{
                    $data['id'] = 0;
                    $data['dev_name'] = "Холболт хийгдээгүй";
                }
                
                $data['lat'] = $pin->lat;
                $data['lng'] = $pin->lng;
                $data['speed'] = $pin->speed;
                $data['datetime'] = $pin->datetime;
                if($data['speed'] != 0){
                    $data['status'] = "Явж байна";
                }else{
                    $data['status'] = "Зогсож байна";
                }
                $alldata[] = $data;
            }
        }else{
            $avalable_devices = Device::select('imei')
            ->where('org_id',\Auth::user()->org_id)
            ->where('status',0)
            ->get();
            $search_devs = [];
            foreach($avalable_devices as $dev){
                $search_devs[$dev->imei] = $dev->imei;
            }

            $pins = LastDistance::select('lat','lng','speed','imei','datetime')
            ->where('lng','!=','00000.0000')
            ->whereIn('imei',$search_devs)
            ->orderBy('datetime','desc')
            ->get();


            $alldata = [];
            foreach($pins as $pin){
                $device_info = $pin->GetDevice($pin->imei);
                if($device_info !=""){
                    $data['id'] = $device_info->id;
                    $data['dev_name'] = $device_info->name;
                }else{
                    $data['id'] = 0;
                    $data['dev_name'] = "Холболт хийгдээгүй";
                }
                $data['lat'] = $pin->lat;
                $data['lng'] = $pin->lng;
                $data['speed'] = $pin->speed;
                $data['datetime'] = $pin->datetime;
                if($data['speed'] != 0){
                    $data['status'] = "Явж байна";
                }else{
                    $data['status'] = "Зогсож байна";
                }
                $alldata[] = $data;
            }

        }

       return response()->json(['data' => $alldata]);


    }

}
