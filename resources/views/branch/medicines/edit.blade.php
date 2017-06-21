@extends('layout')

@section('title')
    <title>Edit Medicines - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Edit Medicines
                </h3>

                <a href="/branch/medicines">
                    <button class="btn btn-default">Go Back</button>
                </a>
            </div>

            <div class="companies col-xs-5">
                <form method="post" action="/branch/medicine/update">
                    <div class="form-group @if($errors->has('medicine')) has-error @endif">
                        <label>Medicine Name</label>
                        <input type="text" class="form-control" name="medicine" placeholder="Name" value="{{old('medicine') ? old('medicine') : $medicine->name}}">
                        @if($errors->has('medicine'))
                            {{$errors->first('medicine')}}
                        @endif
                    </div>

                    <input type="hidden" value="{{$medicine->id}}" name="id">


                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default">Update Medicine</button>
                </form>
            </div>

        </div>
    </div>
@endsection