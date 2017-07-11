<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    function project(){
        return $this->hasMany('App\Project','state');
    }
    
    function company(){
        return $this->hasMany('App\Company','state');
    }
    
    function contractor(){
        return $this->hasMany('App\Contractor','state');
    }
    
    function users(){
        return $this->hasMany('App\Users','state');
    }
    
    function permit_owner(){
        return $this->hasMany('App\Permit_owner','owner_state_id');
    }
    
    function building_report(){
        return $this->hasMany('App\Building_report','state_id');
    }
    
    function order_master(){
        return $this->hasMany('App\Order_master','state');
    }
}
