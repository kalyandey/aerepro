<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
    function plan(){
        return $this->belongsTo('App\Plan','plan_id');
    }
    
    function order_master(){
        return $this->belongsTo('App\Order_master','order_master_id');
    }
}
