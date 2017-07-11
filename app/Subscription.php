<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    function user_subscription(){
        return $this->hasMany('App\User_subscription','subscription_id');
    }
    
    function user_payment(){
        return $this->hasMany('App\User_payment','subscription_id');
    }
    
    function subscriptionUser($user_id, $subId){
        return User_subscription::where('user_id',$user_id)->where('subscription_id',$subId)->first();
    }
    
    function temp_payment(){
        return $this->hasMany('App\Temp_payment','subscription_id');
    }
}
