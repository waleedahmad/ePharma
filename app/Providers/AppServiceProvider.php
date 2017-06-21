<?php

namespace App\Providers;

use App\Medicine;
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
