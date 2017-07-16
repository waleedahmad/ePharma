@extends('layout')

@section('title')
    <title>Register</title>
@endsection

@section('content')
    <form class="form-horizontal register-form" action="/register" method="POST">
        <div class="form-group @if($errors->has('name')) has-error @endif" >
            <label class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                @if($errors->has('name'))
                    {{$errors->first('name')}}
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('email')) has-error @endif">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>
        </div>
        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if($errors->has('password'))
                    {{$errors->first('password')}}
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