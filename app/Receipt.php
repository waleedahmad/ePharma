<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public function transactions(){
        return $this->hasMany('App\Transactions', 'receipt_id', 'id');
    }

    public function total(){
        $total = 0;

        foreach($this->transactions()->get() as $item){
            $total += $item->quantity * $item->price;
        }
        return $total;
    }
}
