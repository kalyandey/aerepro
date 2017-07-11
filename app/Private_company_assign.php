<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private_company_assign extends Model
{
    function assign_company(){
        return $this->belongsTo('App\Private_company','company_id');
    }
    
    function assign_user(){
        return $this->belongsTo('App\Private_company','user_id');
    }
}
