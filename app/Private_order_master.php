<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_order_master extends Model
{
    function order(){
        return $this->hasMany('App\Private_order','order_master_id');
    }
    
    function city_name(){
        return $this->belongsTo('App\City','city');
    }
    
    function state_name(){
         return $this->belongsTo('App\State','state');
    }
    
    function user(){
        return $this->belongsTo('App\Private_company','user_id');
    }
}
