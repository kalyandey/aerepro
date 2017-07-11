<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_project extends Model
{
    function company(){
        return $this->belongsTo('App\Private_company','company_id');
    }
    
    function specs(){
        return $this->hasMany('App\Private_specs','project_id');
    }
    
    function plan(){
        return $this->hasMany('App\Private_plans','project_id');
    }
    
    function assign_project(){
        return $this->belongsTo('App\Private_planroom_assigns','project_id');
    }
    
}
