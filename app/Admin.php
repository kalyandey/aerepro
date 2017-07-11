<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends \Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
   use Authenticatable, CanResetPassword;
    use EntrustUserTrait;
    public function setPasswordAttribute($password){   
        $this->attributes['password'] = bcrypt($password);
    }
    
    public function roleuser(){
       return $this->hasMany('App\Role_user','user_id','id');
    }
}
