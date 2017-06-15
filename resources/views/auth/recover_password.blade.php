@extends('layout')

@section('title')
    <title>ForgetPassword</title>
@endsection
@section('content')
    <form class="form-horizontal reset-password" action="/forgot/password" method="post">
        <div class="form-group" >
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="Email">
                @if($errors->has('email'))
                    {{$errors->first('email')}}
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
                <button type="submit" class="btn btn-default">Recover Password</button>
            </div>
        </div>

        {{csrf_field()}}
    </form>
@endsection
