<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurisdictions extends Model
{
    function building_report(){
        return $this->hasMany('App\Building_report','jurisdiction_id');
    }
}
