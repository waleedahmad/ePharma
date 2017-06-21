@extends('layout')

@section('title')
    <title>Edit Branch - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Edit Branch
                </h3>

                <a href="/admin/branches">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="branches col-xs-5">
                <form method="post" action="/admin/branch/update">

                    <div class="form-group @if($errors->has('company')) has-error @endif">
                        <label>Company</label>
                        <select name="company" class="form-control">
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}" @if($company->id == old('company') || $company->id == $branch->company->id) selected @endif>{{$company->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('company'))
                            {{$errors->first('company')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        <label>Manager Name</label>
                        <input type="name" class="form-control" name="name" placeholder="Name" value="{{old('name') ? old('name') : $branch->manager->name}}">
                        @if($errors->has('name'))
                            {{$errors->first('name')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label>Manager Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email') ? old('email') : $branch->manager->email}}">
                        @if($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        <label>Phone</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Phone No." value="{{old('phone') ? old('phone') : $branch->phone}}">
                        @if($errors->has('phone'))
                            {{$errors->first('phone')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('city')) has-error @endif">
                        <label>City</label>
                        <select name="city" class="form-control">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($city->id == old('city') || $city->id == $branch->loc->city_id) selected @endif>{{$city->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('city'))
                            {{$errors->first('city')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('town')) has-error @endif">
                        <label>Town</label>
                        <input type="text" class="form-control" name="town" placeholder="Town" value="{{old('town') ? old('town') : $branch->loc->name}}">
                        @if($errors->has('town'))
                            {{$errors->first('town')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('address')) has-error @endif">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address') ? old('address') : $branch->address}}">
                        @if($errors->has('address'))
                            {{$errors->first('address')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('open_hours')) has-error @endif">
                        <label>Open Hours</label>
                        <input type="text" class="form-control" name="open_hours" id="open-hours" placeholder="Open Hours" value="{{old('open_hours') ? old('open_hours') : $branch->open_hours}}">
                        @if($errors->has('open_hours'))
                            {{$errors->first('open_hours')}}
                        @endif
                    </div>

                    <div class="form-group @if($errors->has('close_hours')) has-error @endif">
                        <label>Close Hours</label>
                        <input type="text" class="form-control" name="close_hours" id="close-hours" placeholder="Close Hours" value="{{old('close_hours') ? old('close_hours') : $branch->close_hours}}">
                        @if($errors->has('close_hours'))
                            {{$errors->first('close_hours')}}
                        @endif
                    </div>

                    <input type="hidden" name="branch_id" value="{{$branch->id}}">

                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Update Branch</button>
                </form>
            </div>

        </div>
    </div>
@endsection