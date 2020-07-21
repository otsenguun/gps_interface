<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function scopeSearch($query, $s){
    	return $query->where('imei','like','%'.$s.'%')
    	->orWhere('name','like','%'.$s.'%');
    }
}
