<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor_assign extends Model
{
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
    function contractor(){
        return $this->belongsTo('App\Contractor','contractor_id');
    }
}
