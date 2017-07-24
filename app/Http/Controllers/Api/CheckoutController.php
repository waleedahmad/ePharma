<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Receipt;
use App\Stock;
use App\Transactions;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function addItemToCart(Request $request){

        $stock = Stock::find($request->medicine_id);

        if($stock){
            $validator = Validator::make($request->all(), [
                'medicine_id'   =>  'required|exists:medicine_stock,id',
                'quantity'  =>  'required|numeric|integer|min:1|stock_available:'.$request->medicine_id.','.$request->quantity,
            ]);

            if($validator->passes()){
                if($this->itemExistInCart($request->medicine_id)){
                    if($this->incrementCartQuantity($request->medicine_id, $request->quantity)){
                        return response()->json([
                            'Quantity updated in cart'
                        ], 201);
                    }
                }else{
                    if($this->createCartItem($request->medicine_id, $request->quantity)){
                        return response()->json([
                            'Item added to cart'
                        ], 201);
                    }
                }
            }else{
                return response()->json(
                    [
                        'errors'    => $validator->errors()
                    ], 400
                );
            }
        }else{
            return response()->json(
                [
                    'errors'    =>  'Invalid medicine id'
                ], 400
            );
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

        if($item){
            if($item->delete()){
                return response()->json(
                    [
                        'Item removed from cart'
                    ], 200
                );
            }

        }

        return response()->json(
            [
                'errors'    =>  'Item doesn\'t exist in cart',
            ], 400
        );
    }

    public function processCheckout(Request $request){
        if(!Auth::user()->info){
            return response()->json(
                [
                    'errors'    =>  'You need to fill in your contact details'
                ], 401
            );
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
                return response()->json(
                    [
                        'Your checkout has been processed',
                        'receipt_id'    =>  $receipt->id
                    ], 201
                );
            }
        }else{
            return response()->json(
                [
                    'errors'    =>  'You currently have no items in your cart'
                ], 200
            );
        }
    }
}
