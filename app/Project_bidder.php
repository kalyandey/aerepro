<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_bidder extends Model
{
    function bidder(){
        return $this->belongsTo('App\Bidder','bidder_id');
    }
    
    function project(){
        return $this->belongsTo('App\Project','project_id');
    }
}
