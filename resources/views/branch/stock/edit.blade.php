@extends('layout')

@section('title')
    <title>Add Stock - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Edit Stock ({{$stock->medicine->name}})
                </h3>

                <a href="/branch/medicines">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="companies col-xs-5">
                <form method="post" action="/branch/stock/update" enctype="multipart/form-data">

                    <div class="form-group @if($errors->has('category')) has-error @endif">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="">Select Medicine Category</option>
                            <option value="Antipyretics" @if(old('category') === 'Antipyretics' || $stock->category === 'Antipyretics') selected @endif>Antipyretics</option>
                            <option value="Analgesics" @if(old('category') === 'Analgesics' || $stock->category === 'Analgesics') selected @endif>Analgesics</option>
                            <option value="Antimalarial" @if(old('category') === 'Antimalarial' || $stock->category === 'Antimalarial') selected @endif>Antimalarial</option>
                            <option value="Antibiotics" @if(old('category') === 'Antibiotics' || $stock->category === 'Antibiotics') selected @endif>Antibiotics</option>
                            <option value="Antiseptics" @if(old('category') === 'Antiseptics' || $stock->category === 'Antiseptics') selected @endif>Antiseptics</option>
                            <option value="Mood stabilizers" @if(old('category') === 'Mood stabilizers' || $stock->category === 'Mood stabilizers') selected @endif>Mood stabilizers</option>
                            <option value="Hormone replacements" @if(old('category') === 'Hormone replacements' || $stock->category === 'Hormone replacements') selected @endif>Hormone replacements</option>
                            <option value="Oral contraceptive" @if(old('category') === 'Oral contraceptive' || $stock->category === 'Oral contraceptive') selected @endif>Oral contraceptive</option>
                            <option value="Stimulants" @if(old('category') === 'Stimulants' || $stock->category === 'Stimulants') selected @endif>Stimulants</option>
                            <option value="Tranquilizers" @if(old('category') === 'Tranquilizers' || $stock->category === 'Tranquilizers') selected @endif>Tranquilizers</option>
                            <option value="Statins" @if(old('category') === 'Statins' || $stock->category === 'Statins') selected @endif>Statins</option>
                        </select>
                        @if($errors->has('category'))
                            {{$errors->first('category')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('type')) has-error @endif">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Select Medicine Type</option>
                            <option value="Tablet" @if(old('type') === 'Tablet' || $stock->type === 'Tablet') selected @endif>Tablet</option>
                            <option value="Syrup" @if(old('type') === 'Syrup'|| $stock->type === 'Syrup') selected @endif>Syrup</option>
                            <option value="Injectable" @if(old('type') === 'Injectable' || $stock->type === 'Injectable') selected @endif>Injectable</option>
                        </select>
                        @if($errors->has('type'))
                            {{$errors->first('type')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('price')) has-error @endif">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price"
                               value="{{old('price') ? old('price') : $stock->price}}">
                        @if($errors->has('price'))
                            {{$errors->first('price')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('quantity')) has-error @endif">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity"
                               value="{{old('quantity')? old('quantity') : $stock->quantity}}">
                        @if($errors->has('quantity'))
                            {{$errors->first('quantity')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('potency')) has-error @endif">
                        <label>Potency (mg)</label>
                        <input type="text" class="form-control" name="potency" placeholder="Potency in mg"
                               value="{{old('potency') ? old('potency') : $stock->potency}}">
                        @if($errors->has('potency'))
                            {{$errors->first('potency')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('mfg_date')) has-error @endif">
                        <label>Mfg Date</label>
                        <input type="text" class="form-control" name="mfg_date" placeholder="Manufacturing Date"
                               id="mfg-date" value="{{old('mfg_date') ? old('mfg_date') : $stock->mfg_date}}">
                        @if($errors->has('mfg_date'))
                            {{$errors->first('mfg_date')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('expiry_date')) has-error @endif">
                        <label>Expiry Date</label>
                        <input type="text" class="form-control" name="expiry_date" placeholder="Expiry Date"
                               id="expiry-date" value="{{old('expiry_date') ? old('expire_date') : $stock->expiry}}">
                        @if($errors->has('expiry_date'))
                            {{$errors->first('expiry_date')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('stock_photo')) has-error @endif">
                        <label>Photo (Optional)</label>
                        <input type="file" name="stock_photo">
                        <p class="help-block">Product stock photo</p>
                        @if($errors->has('stock_photo'))
                            {{$errors->first('stock_photo')}}
                        @endif
                    </div>

                    <input type="hidden" name="medicine" value="{{$stock->medicine_id}}">
                    <input type="hidden" name="id" value="{{$stock->id}}">

                    @if(Session::has('message'))
                        <div class="form-group">
                            <div class="alert alert-danger">
                                {{Session::get('message')}}
                            </div>
                        </div>
                    @endif

                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Update Stock</button>
                </form>
            </div>

        </div>
    </div>
@endsection