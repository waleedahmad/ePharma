<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Returns index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        if(Auth::check()){
            if(Auth::user()->type === 'su'){
                return view('admin.index');
            }

            if(Auth::user()->type === 'b_admin'){
                return view('branch.index');
            }

            if(Auth::user()->type === 'user'){
                return view('secure.index');
            }
        }else{
            return view('index');
        }
    }
}
