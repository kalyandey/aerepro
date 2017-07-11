<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit_owner extends Model
{
    function state(){
        return $this->belongsTo('App\State','owner_state_id');
    }
    
    function building_report(){
        return $this->hasMany('App\Building_report','permit_owner_id');
    }
}
