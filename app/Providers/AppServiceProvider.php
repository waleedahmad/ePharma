<?php

namespace App\Providers;

use App\Cart;
use App\Medicine;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('duplicate_med', function ($attribute, $value, $parameters, $validator) {
            return Medicine::where('branch_id','=', Auth::user()->branch->id)->where('name','=', $value)->count() == 0;
        });

        Validator::extend('duplicate_med_update', function ($attribute, $value, $parameters, $validator) {
            return Medicine::where('branch_id','=', Auth::user()->branch->id)->where('name','=', $value)->where('id','!=',$parameters[0])->count() == 0;
        });

        Validator::extend('stock_available', function ($attribute, $value, $parameters, $validator) {
            $cart_item = Cart::where('stock_id','=', $parameters[0])->where('user_id', '=', Auth::user()->id);
            if($cart_item->count()){
                $cart_quantity = $cart_item->first()->quantity;
            }else{
                $cart_quantity = 0;
            }
            return Stock::find($parameters[0])->quantity >= $parameters[1] + $cart_quantity;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
