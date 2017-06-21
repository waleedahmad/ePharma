<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Stock;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request){
        $query = $request->medicine;
        $medicines = Medicine::where('name','LIKE', '%'.$query.'%')->get();
        return view('user.search')->with('medicines',$medicines)->with('query', $query);
    }

    public function showMedicine($id){
        $stock = Stock::find($id);
        return view('medicine')->with('stock', $stock);
    }

    public function checkout(){
        return view('user.checkout');
    }
}
