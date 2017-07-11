<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit_type extends Model
{
    function building_report(){
        return $this->hasMany('App\Building_report','permit_type_id');
    }
}
