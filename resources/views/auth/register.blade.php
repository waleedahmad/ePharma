@extends('layout')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <form class="form-horizontal register-form" action="/register" method="POST">
        <div class="form-group">
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" placeholder="Name">
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="Email">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if($errors->has('password'))
                    {{$errors->first('password')}}
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Contact</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="phone" name="phone" maxlength="11" placeholder="Contact number">
                @if($errors->has('phone'))
                    {{$errors->first('phone')}}
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">CNIC</label>
            <div class="col-sm-9">
                <input type="text" id='cnic' class="form-control" name="cnic" placeholder="CNIC">
                @if($errors->has('cnic'))
                    {{$errors->first('cnic')}}
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
                <textarea class="form-control" name="address" placeholder="Address" rows="5"></textarea>
                @if($errors->has('address'))
                    {{$errors->first('address')}}
                @endif
            </div>
        </div>
        @if(Session::has('message'))
            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                    <div class="alert alert-info" role="alert">{{Session::get('message')}}</div>
                </div>
            </div>
        @endif


        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" value="Register" class="btn btn-default">Register</button>
            </div>
        </div>
            {{csrf_field()}}
    </form>
@endsection