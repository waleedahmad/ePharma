<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    public function company(){
        return $this->hasOne('App\Company', 'id', 'company_id');
    }

    public function manager(){
        return $this->hasOne('App\User', 'id', 'manager_id');
    }
}
