<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Receipt;
use App\Transactions;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function addItemToCart(Request $request){

        $validator = Validator::make($request->all(), [
            'quantity'  =>  'required|numeric|integer|min:1|stock_available:'.$request->medicine_id.','.$request->quantity,
        ]);

        if($validator->passes()){
            if($this->itemExistInCart($request->medicine_id)){
                if($this->incrementCartQuantity($request->medicine_id, $request->quantity)){
                    $request->session()->flash('message', 'Medicine quantity updated in cart');
                    return redirect('/checkout');
                }
            }else{
                if($this->createCartItem($request->medicine_id, $request->quantity)){
                    $request->session()->flash('message', 'Medicine successfully added to the your cart');
                    return redirect('/checkout');
                }
            }
        }else{
            return redirect('/medicine/'.$request->medicine_id)->withErrors($validator);
        }
    }

    public function itemExistInCart($id){
        return Cart::where('stock_id','=', $id)->where('user_id','=', Auth::user()->id)->count();
    }

    public function incrementCartQuantity($id, $quantity){

        $cart_item = Cart::where('stock_id','=', $id)->where('user_id','=', Auth::user()->id)->first();
        $cart_item->quantity = $cart_item->quantity + $quantity;
        return $cart_item->save();
    }

    public function createCartItem($id, $quantity){
        $cart_item = new Cart();
        $cart_item->stock_id = $id;
        $cart_item->quantity = $quantity;
        $cart_item->user_id = Auth::user()->id;
        return $cart_item->save();
    }

    public function removeItemFromCart(Request $request){
        $item = Cart::find($request->id);

        if($item->delete()){
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function processCheckout(Request $request){
        if(!Auth::user()->info){
            $request->session()->flash('message', 'Please add contact information before checking out');
            return redirect('/user/info');
        }

        $items = Cart::where('user_id', '=', Auth::user()->id);
        $orders = [];
        if($items->count()){
            foreach($items->get()->pluck('stock.medicine.branch.id')->unique()->toArray() as $b_id){
                $orders['order_'.$b_id]['branch_id'] = $b_id;
                $orders['order_'.$b_id]['items'] = [];
            }
            foreach($items->get() as $item){
                array_push($orders['order_'.$item->stock->medicine->branch->id]['items'], $item);
            }

            $receipt = new Receipt();
            $receipt->user_id = Auth::user()->id;

            foreach($orders as $s_order){
                $order = new Order();
                $order->branch_id = $s_order['branch_id'];
                $order->user_id = Auth::user()->id;
                $order->cleared = false;

                if($order->save() && $receipt->save()){
                    foreach($s_order['items'] as $item){
                        $order_item = new OrderItem();
                        $receipt_items = new Transactions();

                        $order_item->order_id = $order->id;
                        $order_item->medicine_name = $item->stock->medicine->name;
                        $order_item->quantity = $item->quantity;
                        $order_item->category = $item->stock->category;
                        $order_item->price = $item->stock->price;
                        $order_item->potency = $item->stock->potency;
                        $order_item->type = $item->stock->type;
                        $item->stock->quantity -= $item->quantity;
                        $item->stock->save();
                        $order_item->save();

                        $receipt_items->receipt_id = $receipt->id;
                        $receipt_items->medicine_name = $item->stock->medicine->name;
                        $receipt_items->quantity = $item->quantity;
                        $receipt_items->category = $item->stock->category;
                        $receipt_items->price = $item->stock->price;
                        $receipt_items->potency = $item->stock->potency;
                        $receipt_items->type = $item->stock->type;
                        $receipt_items->save();
                    }
                }
            }

            if($items->delete()){
                $request->session()->flash('message', 'Checkout processed successfully');
                return redirect('/receipt/'.$receipt->id);
            }
        }else{
            return redirect('/checkout');
        }
    }
}
