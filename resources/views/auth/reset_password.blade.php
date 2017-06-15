@extends('layout');

@section('title')
    <title>ChangePassword</title>
@endsection

@section('content')
    <form class="form-horizontal reset-password" action="/reset/password" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9" >
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            @if($errors->has('password'))
                {{$errors->first('password')}}
            @endif
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Confirm Pasword</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            </div>
            @if($errors->has('confirm_password'))
                {{$errors->first('confirm_password')}}
            @endif
        </div>

        <input type="hidden" name="email" value="{{$email}}">
        <input type="hidden" name="token" value="{{$token}}">

        <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
                <button type="submit" value="reset password" class="btn btn-default">Reset Password</button>
            </div>
        </div>
        {{csrf_field()}}
    </form>
@endsection