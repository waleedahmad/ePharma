@extends('layout')

@section('title')
    <title>Administrators - ePharm</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Administrators
                </h3>

                <button class="btn btn-default">Add Admin</button>
            </div>

        </div>
    </div>
@endsection