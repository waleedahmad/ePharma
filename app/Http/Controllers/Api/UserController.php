<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\City;
use App\Http\Controllers\Controller;
use App\Medicine;
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

    public function getUser(){
        return Auth::guard('api')->user();
    }

    public function search(Request $request){
        $query = $request->medicine;
        $medicines = Medicine::where('name','LIKE', '%'.$query.'%')->with('stock')->get();
        return response()->json($medicines, 200);
    }

    public function showMedicine(Request $request){
        $stock = Stock::with('medicine')->find($request->medicine);
        return response()->json($stock, 200);
    }

    public function checkout(){
        $items = Cart::with('stock.medicine')->where('user_id', '=', Auth::guard('api')->user()->id)->get();

        return response()->json([
            'items' => $items,
            'total' =>  $this->getCartTotal($items)
        ], 200);
    }

    public function showReceipts(){
        $receipts = Receipt::with('transactions')->where('user_id','=', Auth::user()->id)->get();
        return response()->json([
            $receipts
        ], 200);
    }

    public function getReceipt(Request $request){
        $receipt = Receipt::with('transactions')->find($request->id);
        if($receipt){
            return response()->json([
                $receipt
            ], 200);
        }
        return response()->json([
            'error' =>  'Invalid receipt ID'
        ], 400);
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

    public function saveUserInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'city'  =>  'required',
            'town'  =>  'required',
            'cnic'  =>  'required|numeric|min:15',
            'phone' =>  'required|numeric|min:11',
            'address'   =>  'required'
        ]);

        if($validator->passes()){
            $info = new UserInfo();
            $info->user_id = Auth::user()->id;
            $info->location = $request->town;
            $info->cnic = $request->cnic;
            $info->phone_no = $request->phone;
            $info->address = $request->address;

            if($info->save()){
                $request->session()->flash('message', 'Contact information updated');
                return redirect('/');
            }
        }else{
            return redirect('/user/info')->withErrors($validator)->withInput();
        }
    }

    public function updateUserInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'city'  =>  'required',
            'town'  =>  'required',
            'cnic'  =>  'required|numeric|min:15',
            'phone' =>  'required|numeric|min:11',
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
