@extends('layout')

@section('title')
    <title>Contact Information - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                Add Contact Information
            </h4>
        </div>

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif


        <div class="user-info">

            <form class="form-horizontal col-xs-6" action="/user/info" method="post">

                <div class="form-group @if($errors->has('city')) has-error @endif">
                    <label>City</label>
                    <select name="city" class="form-control" id="user-info-city">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                        {{$errors->first('city')}}
                    @endif
                </div>

                <div class="form-group @if($errors->has('town')) has-error @endif">
                    <label>Supported Locations</label>
                    <select name="town" class="form-control" id="user-info-town">
                        <option value="">Select Town</option>
                    </select>
                    @if($errors->has('town'))
                        {{$errors->first('town')}}
                    @endif
                </div>

                <div class="form-group @if($errors->has('address')) has-error @endif">
                    <label>Address</label>
                    <input type="phone" class="form-control" name="address" placeholder="Address" value="{{old('address')}}">
                    @if($errors->has('address'))
                        {{$errors->first('address')}}
                    @endif
                </div>

                <div class="form-group @if($errors->has('cnic')) has-error @endif">
                    <label>CNIC</label>
                    <input type="name" class="form-control" name="cnic" placeholder="CNIC #" value="{{old('cnic')}}">
                    @if($errors->has('cnic'))
                        {{$errors->first('cnic')}}
                    @endif
                </div>

                <div class="form-group @if($errors->has('phone')) has-error @endif">
                    <label>Phone No.</label>
                    <input type="name" class="form-control" name="phone" placeholder="Phone #" value="{{old('phone')}}">
                    @if($errors->has('phone'))
                        {{$errors->first('phone')}}
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
                {{csrf_field()}}
            </form>

        </div>
    </div>
@endsection