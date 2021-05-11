<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public function scopeSearch($query, $s){
    	return $query->where('phone','like','%'.$s.'%')
    	->orWhere('name','like','%'.$s.'%');
    }
}
