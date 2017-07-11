<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building_report extends Model
{
    
    function state(){
        return $this->belongsTo('App\State','state_id');
    }
    
    function county(){
        return $this->belongsTo('App\County','county_id');
    }
    
    function permit_county(){
        return $this->belongsTo('App\County','permit_county_id');
    }
    
    function permit_type(){
        return $this->belongsTo('App\Permit_type','permit_type_id');
    }
    
    function permit_owner(){
        return $this->belongsTo('App\Permit_owner','permit_owner_id');
    }
    
    function contractor(){
        return $this->belongsTo('App\Contractor','contractor_id');
    }
    
    function permit_file(){
        return $this->hasMany('App\Permit','building_report_id');
    }
    
    function jurisdictions(){
        return $this->belongsTo('App\Jurisdictions','jurisdiction_id');
    }
}
