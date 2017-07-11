<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    function Project(){
        return $this->hasMany('App\Project','county_id');
    }
    
    function building_report(){
        return $this->hasMany('App\Building_report','county_id');
    }
    
    function building_report_permit(){
        return $this->hasMany('App\Building_report','permit_county_id');
    }
}
