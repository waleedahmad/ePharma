@extends('layout')

@section('title')
    <title>Add Company - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Add Company
                </h3>

                <a href="/admin/companies">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="companies col-xs-5">
                <form method="post" action="/admin/company">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                        @if($errors->has('name'))
                            {{$errors->first('name')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        <label>Phone</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Phone No." value="{{old('phone')}}">
                        @if($errors->has('phone'))
                            {{$errors->first('phone')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('address')) has-error @endif">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address')}}">
                        @if($errors->has('address'))
                            {{$errors->first('address')}}
                        @endif
                    </div>

                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Add Company</button>
                </form>
            </div>

        </div>
    </div>
@endsection