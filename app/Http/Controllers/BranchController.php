<?php

namespace App\Http\Controllers;

use App\Stock;
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
        $validator = Validator::make($request->all(), [
            'medicine'  =>  'required',
            'category'  =>  'required',
            'type'  =>  'required',
            'price'  =>  'required|numeric|min:1',
            'quantity'  =>  'required|numeric|integer|min:1',
            'potency'   =>  'required|numeric|integer|min:1',
            'mfg_date'  =>  'required',
            'expiry_date'  =>  'required',
        ]);

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

                if($stock->save()){
                    return redirect('/branch/stock');
                }
            }

        }else{
            return redirect('/branch/stock/add')->withErrors($validator)->withInput();
        }
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
        $validator = Validator::make($request->all(), [
            'medicine'  =>  'required',
            'category'  =>  'required',
            'type'  =>  'required',
            'price'  =>  'required|numeric|min:1',
            'quantity'  =>  'required|numeric|integer|min:1',
            'potency'   =>  'required|numeric|integer|min:1',
            'mfg_date'  =>  'required',
            'expiry_date'  =>  'required',
        ]);

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

    public function getStockId($id, $category, $type, $potency){
        return Stock::where('medicine_id', $id)->where('category', '=', $category)
            ->where('type','=', $type)->where('potency', '=', $potency)->first()->id;
    }



    public function deleteStock(Request $request){
        $stock = Stock::find($request->id);

        if($stock->delete()){
            return response()->json(true);
        }

        return response()->json(false);
    }


}
