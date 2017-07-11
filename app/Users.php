<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public function setPasswordAttribute($password){   
        $this->attributes['password'] = bcrypt($password);
    }
    
    function project(){
        return $this->hasMany('App\Users','awarded_to');
    }
    
    function state_name(){
        return $this->belongsTo('App\State','state');
    }
    
    //function city_name(){
    //    return $this->belongsTo('App\City','city');
    //}
    
    function order_user(){
        return $this->hasMany('App\Order','user_id');
    }
    
    function pay(){
        return $this->hasMany('App\User_payment','user_id');
    }
    function user_subscription(){
        return $this->hasMany('App\User_subscription','user_id');
    }
    function temp_payment(){
        return $this->hasOne('App\Temp_payment','user_id');
    }
}
