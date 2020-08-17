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

        
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if($start_date == ""){
            $start_date = date('Y-m-d').' 00:00:00';
        }
        if($end_date == ""){
            $end_date = date('Y-m-d').' 23:59:59';
        }


        $locations = Data::select('lat','lng','datetime','speed')->where('imei',$device->imei)
        ->orderBy('id','asc')
        ->where('lng','!=','00000.0000')
        ->whereBetween('created_at',[$start_date,$end_date])
        ->get();

        $datas = Data::where('imei',$device->imei)
        ->orderBy('id','desc')
         ->where('lng','!=','00000.0000')
        ->whereBetween('created_at',[$start_date,$end_date])
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
        return view('pages.device.index',compact('datas','device','locations','start_date','end_date','top_speed','stop_time','run_time','avarage_speed'));
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

    public function main(Request $request){


        $devices = Device::select('name','imei')->get();

        $device_datas = [];

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
            }
        }

        return view('pages.main',compact('devices','device_datas'));

    }
    

    public function main_ajax(Request $request){

        $devices = $request->imeis;

        $data = [];

        foreach ($devices as $key => $value) {

            $pin = Data::select('lat','lng','speed')
            ->where('imei',$value)
            ->where('lng','!=','00000.0000')
            ->orderBy('created_at','asc')
            ->first();

            if($pin !=''){
                $data[] = $pin;
            }

        }

       return response()->json(['data' => $data]); 
       

    }
}
