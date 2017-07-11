<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_master extends Model
{
    function order(){
        return $this->hasMany('App\Order','order_master_id');
    }
    
    function state_name(){
         return $this->belongsTo('App\State','states');
    }
    
    function user(){
        return $this->belongsTo('App\Users','user_id');
    }
}
