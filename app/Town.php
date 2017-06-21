<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'towns';

    public function city(){
        return $this->hasOne('App\City', 'id', 'city_id');
    }
}
