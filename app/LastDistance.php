<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;

class LastDistance extends Model
{

    public function GetDeviceName(){

        $name = "";

        $device = Device::select('name')
        ->where('imei',$this->imei)
        ->first();

        if($device != ""){
            $name = $device->name;
        }else{
            $name = $this->imei;
        }

        return $name;

    }

}
