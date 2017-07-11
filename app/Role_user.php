<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    
    protected $table ="role_user";
    public $primaryKey  = 'user_id';
    public $timestamps = false;
    public function admin(){
       return $this->belongsTo('App\Admin','user_id','id');
    }
}
