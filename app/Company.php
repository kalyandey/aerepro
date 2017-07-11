<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
    function state_name(){
        return $this->belongsTo('App\State','state');
    }
}
