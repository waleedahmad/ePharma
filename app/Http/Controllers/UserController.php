<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Medicine;
use App\Order;
use App\Receipt;
use App\Stock;
use App\Town;
use App\Transactions;
use App\User;
use App\UserInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\CutArrayStub;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function search(Request $request){
        $query = $request->medicine;

        if(Auth::check()){
            $medicines = Medicine::whereHas('branch', function($q) {
                $q->where('location', '=', Auth::user()->info->location);
            })->where('name','LIKE', '%'.$query.'%')->get();
        }else{
            $medicines = Medicine::where('name','LIKE', '%'.$query.'%')->get();

        }

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
        $orders = Order::where('user_id','=', Auth::user()->id)->get();
        return view('user.receipts')->with('receipts', $receipts)->with('orders', $orders);
    }

    public function getReceipt($id){
        $receipt = Receipt::find($id);
        return view('user.receipt')->with('receipt', $receipt);
    }

    public function getOrderItems($id){
        $order = Order::find($id);
        return view('user.order')->with('order', $order);
    }

    public function getCartTotal($items){
        $total = 0;

        foreach($items as $item){
            $total += $item->stock->price * $item->quantity;
        }
        return $total;
    }

    public function getUserInfo(){
        $info = Auth::user()->info;
        $cities = City::all();
        $towns = ($info) ? Town::where('city_id', '=', $info->town->city_id)->get() : null;

        return view(($info ? 'user.update_info' : 'user.add_info'))->with('info', $info)->with('cities', $cities)->with('towns', $towns);
    }

    public function updateUserInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'city'  =>  'required',
            'town'  =>  'required',
            'cnic'  =>  [
                'required',
                'regex:/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/',
            ],
            'phone' =>  'required|numeric|phone:PK',
            'address'   =>  'required'
        ]);

        if($validator->passes()){
            $info = UserInfo::find($request->id);
            $info->user_id = Auth::user()->id;
            $info->location = $request->town;
            $info->cnic = $request->cnic;
            $info->phone_no = $request->phone;
            $info->address = $request->address;

            if($info->save()){
                $request->session()->flash('message', 'Contact information updated');
                return redirect('/user/info');
            }
        }else{
            return redirect('/user/info')->withErrors($validator)->withInput();
        }
    }

    public function getTowns(Request $request){
        $towns = Town::where('city_id', '=', $request->city_id)->get();
        return response()->json($towns);
    }

}
