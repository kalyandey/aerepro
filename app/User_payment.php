<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_payment extends Model
{
    function user(){
        return $this->belongsTo('App\Users','user_id');
    }
    
    function subscription(){
        return $this->belongsTo('App\Subscription','subscription_id');
    }
}
