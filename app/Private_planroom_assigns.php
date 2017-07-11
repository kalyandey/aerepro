<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_planroom_assigns extends Model
{
    function assign_company(){
        return $this->belongsTo('App\Private_company','company_id');
    }
    
    function assign_user(){
        return $this->belongsTo('App\Private_company','user_id');
    }
    
    function assign_project(){
        return $this->belongsTo('App\Private_project','project_id');
    }
}
