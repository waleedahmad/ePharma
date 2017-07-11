<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    public function stock(){
        return $this->hasOne('App\Stock', 'id', 'stock_id');
    }
}
