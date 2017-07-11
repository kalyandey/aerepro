<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    function state_name(){
        return $this->belongsTo('App\State','state');
    }
    
    function project(){
        return $this->hasMany('App\Project','contractor_id');
    }
    
    function building_report(){
        return $this->hasMany('App\Building_report','contractor_id');
    }
    
    function contractor_assign(){
        return $this->hasMany('App\Contractor_assign','contractor_id');
    }
}
