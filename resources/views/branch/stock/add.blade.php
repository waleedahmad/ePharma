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
                    Add Stock
                </h3>

                <a href="/branch/medicines">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="companies col-xs-5">
                <form method="post" action="/branch/stock" enctype="multipart/form-data">
                    <div class="form-group @if($errors->has('medicine')) has-error @endif">
                        <label>Medicine</label>
                        <select name="medicine" class="form-control">
                            <option value="">Select Medicine</option>
                            @foreach($medicines as $medicine)
                                <option value="{{$medicine->id}}" @if(old('medicine') == $medicine->id) selected @endif>{{$medicine->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('medicine'))
                            {{$errors->first('medicine')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('category')) has-error @endif">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="">Select Medicine Category</option>
                            <option value="Antipyretics" @if(old('category') === 'Antipyretics') selected @endif>Antipyretics</option>
                            <option value="Analgesics" @if(old('category') === 'Analgesics') selected @endif>Analgesics</option>
                            <option value="Antimalarial" @if(old('category') === 'Antimalarial') selected @endif>Antimalarial</option>
                            <option value="Antibiotics" @if(old('category') === 'Antibiotics') selected @endif>Antibiotics</option>
                            <option value="Antiseptics" @if(old('category') === 'Antiseptics') selected @endif>Antiseptics</option>
                            <option value="Mood stabilizers" @if(old('category') === 'Mood stabilizers') selected @endif>Mood stabilizers</option>
                            <option value="Hormone replacements" @if(old('category') === 'Hormone replacements') selected @endif>Hormone replacements</option>
                            <option value="Oral contraceptive" @if(old('category') === 'Oral contraceptive') selected @endif>Oral contraceptive</option>
                            <option value="Stimulants" @if(old('category') === 'Stimulants') selected @endif>Stimulants</option>
                            <option value="Tranquilizers" @if(old('category') === 'Tranquilizers') selected @endif>Tranquilizers</option>
                            <option value="Statins" @if(old('category') === 'Statins') selected @endif>Statins</option>
                        </select>
                        @if($errors->has('category'))
                            {{$errors->first('category')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('type')) has-error @endif">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Select Medicine Type</option>
                            <option value="Tablet" @if(old('type') === 'Tablet') selected @endif>Tablet</option>
                            <option value="Syrup" @if(old('type') === 'Syrup') selected @endif>Syrup</option>
                            <option value="Injectable" @if(old('type') === 'Injectable') selected @endif>Injectable</option>
                        </select>
                        @if($errors->has('type'))
                            {{$errors->first('type')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('price')) has-error @endif">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price" value="{{old('price')}}">
                        @if($errors->has('price'))
                            {{$errors->first('price')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('quantity')) has-error @endif">
                        <label>Quantity</label>
                        <input type="text" class="form-control" name="quantity" placeholder="Quantity" value="{{old('quantity')}}">
                        @if($errors->has('quantity'))
                            {{$errors->first('quantity')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('potency')) has-error @endif">
                        <label>Potency (mg)</label>
                        <input type="text" class="form-control" name="potency" placeholder="Potency in mg" value="{{old('potency')}}">
                        @if($errors->has('potency'))
                            {{$errors->first('potency')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('mfg_date')) has-error @endif">
                        <label>Mfg Date</label>
                        <input type="text" class="form-control" name="mfg_date" placeholder="Manufacturing Date" id="mfg-date" value="{{old('mfg_date')}}">
                        @if($errors->has('mfg_date'))
                            {{$errors->first('mfg_date')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('expiry_date')) has-error @endif">
                        <label>Expiry Date</label>
                        <input type="text" class="form-control" name="expiry_date" placeholder="Expiry Date" id="expiry-date" value="{{old('expiry_date')}}">
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


                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Add Stock</button>
                </form>
            </div>

        </div>
    </div>
@endsection