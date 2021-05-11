<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Customers;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query, $s){
    	return $query->where('email','like','%'.$s.'%')
    	->orWhere('name','like','%'.$s.'%');
    }

    public function companyName(){

        $name =  '';
        $customer = Customers::select('name')->where('id',$this->org_id)->first();
        if($customer !=""){
            $name = $customer->name;
        }
        return $name;

    }

}
