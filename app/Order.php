<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function items(){
        return $this->hasMany('App\OrderItem', 'order_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function total(){
        $total = 0;

        foreach($this->items()->get() as $item){
            $total += $item->quantity * $item->price;
        }
        return $total;
    }
}
