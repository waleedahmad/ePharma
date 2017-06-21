<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'medicine_stock';

    public function medicine(){
        return $this->hasOne('App\Medicine', 'id', 'medicine_id');
    }
}
