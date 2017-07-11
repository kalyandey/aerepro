<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    function building_report(){
        return $this->belongsTo('App\Building_report','building_report_id');
    }
}
