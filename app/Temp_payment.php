<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_payment extends Model
{
    function users(){
        return $this->belongsTo('App\Users','user_id');
    }
    function subscription(){
        return $this->belongsTo('App\Subscription','subscription_id');
    }
}
