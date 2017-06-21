<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    public function branch(){
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }

    public function stock(){
        return $this->hasMany('App\Stock', 'medicine_id', 'id');
    }
}
