<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    
     
}
