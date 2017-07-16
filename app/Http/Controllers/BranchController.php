<?php

namespace App\Http\Controllers;

use App\Order;
use App\Stock;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Branch;
use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function getMedicines(){
        $medicines = Medicine::where('branch_id','=', Auth::user()->branch->id)->get();
        return view('branch.medicines')->with('medicines', $medicines);
    }

    public function getAddMedicine(){
        return view('branch.medicines.add');
    }

    public function getEditMedicine($id){
        $medicine = Medicine::find($id);
        return view('branch.medicines.edit')->with('medicine', $medicine);
    }

    public function addMedicine(Request $request){

        $validator = Validator::make($request->all(), [
            'medicine'  =>  'required|duplicate_med',
        ]);

        if($validator->passes()){
            $medicine = new Medicine();
            $medicine->name = $request->medicine;
            $medicine->branch_id = Auth::user()->branch->id;
            if($medicine->save()){
                return redirect('/branch/medicines');
            }
        }else{
            return redirect('/branch/medicine/add')->withErrors($validator)->withInput();
        }
    }

    public function updateMedicine(Request $request){
        $medicine = Medicine::find($request->id);

        $validator = Validator::make($request->all(), [
            'medicine'  =>  'required|duplicate_med_update:'.$request->id,
        ]);

        if($validator->passes()){
            $medicine->name = $request->medicine;
            if($medicine->save()){
                return redirect('/branch/medicines');
            }
        }else{
            return redirect('/branch/medicine/edit/'.$medicine->id)->withErrors($validator)->withInput();
        }
    }



    public function deleteMedicine(Request $request){
        $medicine = Medicine::find($request->id);

        if($medicine->delete()){
            return response()->json(true);
        }

        return response()->json(false);
    }


    public function getStock(){
        $medicines = Medicine::where('branch_id','=', Auth::user()->branch->id)->pluck('id');
        $stock = Stock::whereIn('medicine_id', $medicines)->get();
        return view('branch.stock')->with('stock', $stock);
    }

    public function getAddStock(){
        $medicines = Medicine::where('branch_id','=', Auth::user()->branch->id)->get();
        return view('branch.stock.add')->with('medicines', $medicines);
    }

    public function addStock(Request $request){

        $rules = [
            'medicine'  =>  'required',
            'category'  =>  'required',
            'type'  =>  'required',
            'price'  =>  'required|numeric|min:1',
            'quantity'  =>  'required|numeric|integer|min:1',
            'potency'   =>  'required|numeric|integer|min:1',
            'mfg_date'  =>  'required',
            'expiry_date'  =>  'required',
        ];

        if($request->hasFile('stock_photo')){
            $rules['stock_photo'] = 'required|file|image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){

            $medicine_id = $request->medicine;
            $quantity = $request->quantity;
            $category = $request->category;
            $expiry = $request->expiry_date;
            $mfg_date = $request->mfg_date;
            $price = $request->price;
            $potency = $request->potency;
            $type = $request->type;

            if($this->stockExist($medicine_id, $category, $type, $potency)){

                $stock = Stock::where('medicine_id','=',$medicine_id)->first();
                $stock->medicine_id = $medicine_id;
                $stock->quantity = $quantity + $stock->quantity;
                $stock->category = $category;
                $stock->expiry = $expiry;
                $stock->mfg_date = $mfg_date;
                $stock->price = $price;
                $stock->potency = $potency;
                $stock->type = $type;
                $stock->image_uri = ($request->hasFile('stock_photo')) ? $this->uploadStockPhotoAndGetUri($request->file('stock_photo')) : '/img/no_image_available.jpeg';

                if($stock->save()){
                    return redirect('/branch/stock');
                }
            }else{
                $stock = new Stock();
                $stock->medicine_id = $medicine_id;
                $stock->quantity = $quantity;
                $stock->category = $category;
                $stock->expiry = $expiry;
                $stock->mfg_date = $mfg_date;
                $stock->price = $price;
                $stock->potency = $potency;
                $stock->type = $type;
                $stock->image_uri = ($request->hasFile('stock_photo')) ? $this->uploadStockPhotoAndGetUri($request->file('stock_photo')) : '/img/no_image_available.jpeg';

                if($stock->save()){
                    return redirect('/branch/stock');
                }
            }

        }else{
            return redirect('/branch/stock/add')->withErrors($validator)->withInput();
        }
    }

    private function uploadStockPhotoAndGetUri($file){
        $path = Storage::disk('public')->putFileAs(
            'stock', $file, str_random(10).'.'.$file->getClientOriginalExtension()
        );
        return $path;
    }

    public function stockExist($id, $category, $type, $potency){
        return Stock::where('medicine_id', $id)->where('category', '=', $category)
                    ->where('type','=', $type)->where('potency', '=', $potency)->count();
    }

    public function getEditStock($id){
        $stock = Stock::find($id);
        $medicines = Medicine::where('branch_id','=', Auth::user()->branch->id)->get();
        return view('branch.stock.edit')->with('stock', $stock)->with('medicines', $medicines);
    }

    public function updateStock(Request $request){
        $rules = [
            'medicine'  =>  'required',
            'category'  =>  'required',
            'type'  =>  'required',
            'price'  =>  'required|numeric|min:1',
            'quantity'  =>  'required|numeric|integer|min:1',
            'potency'   =>  'required|numeric|integer|min:1',
            'mfg_date'  =>  'required',
            'expiry_date'  =>  'required',
        ];

        if($request->hasFile('stock_photo')){
            $rules['stock_photo'] = 'required|file|image';
        }

        $validator = Validator::make($request->all(), $rules);

        $medicine_id = $request->medicine;
        $quantity = $request->quantity;
        $category = $request->category;
        $expiry = $request->expiry_date;
        $mfg_date = $request->mfg_date;
        $price = $request->price;
        $potency = $request->potency;
        $type = $request->type;

        if($validator->passes()){
            $stock = Stock::find($request->id);
            $stock->quantity = $quantity + $stock->quantity;
            $stock->category = $category;
            $stock->expiry = $expiry;
            $stock->mfg_date = $mfg_date;
            $stock->price = $price;
            $stock->potency = $potency;
            $stock->type = $type;
            $stock->image_uri = ($request->hasFile('stock_photo')) ? $this->updateStockPhotoAndGetURI($request->file('stock_photo'), $stock->image_uri) : $stock->image_uri;

            if($this->stockExist($medicine_id, $category, $type, $potency)){
                if($this->getStockId($medicine_id, $category, $type, $potency) == $request->id){
                    if ($stock->save()) {
                        return redirect('/branch/stock');
                    }
                }else{
                    $request->session()->flash('message', 'Stock already exists');
                    return redirect('/branch/stock/edit/'.$request->id);
                }
            }else {
                if ($stock->save()) {
                    return redirect('/branch/stock');
                }
            }

        }else{
            return redirect('/branch/stock/edit/'.$request->id)->withErrors($validator)->withInput();
        }
    }

    private function updateStockPhotoAndGetURI($file, $old_uri){
        if(!$this->hasDefaultStockImage($old_uri)){
            $this->deleteStockImage($old_uri);
        }

        $path = Storage::disk('public')->putFileAs(
            'stock', $file, str_random(10).'.'.$file->getClientOriginalExtension()
        );
        return $path;
    }

    private function hasDefaultStockImage($uri){
        return $uri === '/img/no_image_available.jpeg';
    }

    private function deleteStockImage($uri){
        return Storage::disk('public')->delete($uri);
    }

    public function getStockId($id, $category, $type, $potency){
        return Stock::where('medicine_id', $id)->where('category', '=', $category)
            ->where('type','=', $type)->where('potency', '=', $potency)->first()->id;
    }


    public function deleteStock(Request $request){
        $stock = Stock::find($request->id);

        if(!$this->hasDefaultStockImage($stock->image_uri)){
            $this->deleteStockImage($stock->image_uri);
        }

        if($stock->delete()){
            return response()->json(true);
        }

        return response()->json(false);
    }

    public function branchOrders(){
        $orders = Order::where('branch_id', '=', Auth::user()->branch->id)->orderBy('created_at', 'DESC')->get();
        return view('branch.orders')->with('orders', $orders);
    }

    public function viewOrder($id){
        $order = Order::find($id);
        return view('branch.order')->with('order', $order);
    }

    public function clearOrders($id, Request $request){
        $order = Order::find($id);
        $order->cleared = true;
        if($order->save()){
            $request->session()->flash('message', 'Order successfully cleared');
            return redirect('/branch/order/'.$order->id);
        }
    }
}
