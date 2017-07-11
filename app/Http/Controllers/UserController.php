<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Medicine;
use App\Receipt;
use App\Stock;
use App\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\CutArrayStub;
use Validator;
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
        $items = Cart::where('user_id', '=', Auth::user()->id)->get();

        return view('user.checkout')->with('items', $items)->with('total', $this->getCartTotal($items));
    }

    public function showReceipts(){
        $receipts = Receipt::where('user_id','=', Auth::user()->id)->get();
        return view('user.receipts')->with('receipts', $receipts);
    }

    public function getReceipt($id){
        $receipt = Receipt::find($id);
        return view('user.receipt')->with('receipt', $receipt);
    }

    public function getCartTotal($items){
        $total = 0;

        foreach($items as $item){
            $total += $item->stock->price * $item->quantity;
        }
        return $total;
    }

}
