@extends('layout')

@section('title')
    <title>Login</title>
@endsection
@section('content')
    <form class="form-horizontal login-form" action="/login" method="post">

        <div class="form-group @if($errors->has('email')) has-error @endif" >
            <label class="col-sm-3 control-label">EMAIL</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
                @endif
            </div>
        </div>

        <div class="form-group @if($errors->has('password')) has-error @endif">
            <label class="col-sm-3 control-label">PASSWORD</label>
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
                <a href="/forgot/password">Forgot password?</a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" value="login" class="btn btn-default">Login</button>
            </div>
        </div>
        
        {{csrf_field()}}
    </form>
@endsection