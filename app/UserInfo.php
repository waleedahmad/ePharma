<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';

    public function town(){
        return $this->hasOne('App\Town', 'id', 'location');
    }
}
