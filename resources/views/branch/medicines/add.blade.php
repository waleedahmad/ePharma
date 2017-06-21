@extends('layout')

@section('title')
    <title>Add Medicines - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Add Medicines
                </h3>

                <a href="/branch/medicines">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="companies col-xs-5">
                <form method="post" action="/branch/medicine">
                    <div class="form-group @if($errors->has('medicine')) has-error @endif">
                        <label>Medicine Name</label>
                        <input type="text" class="form-control" name="medicine" placeholder="Name" value="{{old('medicine')}}">
                        @if($errors->has('medicine'))
                            {{$errors->first('medicine')}}
                        @endif
                    </div>

                    {{--<div class="form-group @if($errors->has('type')) has-error @endif">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="">Select Medicine Type</option>
                            <option value="Tablet" @if(old('type') === 'Tablet') selected @endif>Tablet</option>
                            <option value="Syrup" @if(old('type') === 'Syrup') selected @endif>Syrup</option>
                            <option value="Injectable" @if(old('type') === 'Injectable') selected @endif>Injectable</option>
                        </select>
                    </div>--}}

                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Add Medicine</button>
                </form>
            </div>

        </div>
    </div>
@endsection