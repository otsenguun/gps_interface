<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;

class LastDistance extends Model
{

    public function GetDevice(){

        $name = "";

        $device = Device::select('id','name')
        ->where('imei',$this->imei)
        ->first();

        if($device != ""){
            $name = $device;
        }

        return $name;

    }

}
