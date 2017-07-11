<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_order extends Model
{
    function project(){
        return $this->belongsTo('App\Private_project','project_id');
    }
    
    function plan(){
        return $this->belongsTo('App\Private_plans','plan_id');
    }
    
    function order_master(){
        return $this->belongsTo('App\Private_order_master','order_master_id');
    }
}
