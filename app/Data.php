<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public function scopeSearch($query, $s){
    	return $query->where('imei','like','%'.$s.'%');
    }
}
