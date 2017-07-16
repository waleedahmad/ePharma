<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Stock;
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
                $branch = Branch::where('manager_id', '=', Auth::user()->id)->first();
                return view('branch.index')->with('branch', $branch);
            }

            if(Auth::user()->type === 'user'){
                $products = Stock::paginate(20);
                return view('user.index')->with('products', $products);
            }
        }else{
            return view('index');
        }
    }

    public function getCategorizedMedicines($category){
        $products = Stock::where('category', '=', $category)->paginate(20);
        return view('user.index')->with('products', $products);
    }
}
