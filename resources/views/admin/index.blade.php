@extends('layout')

@section('title')
    <title>Admin - ePharm</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Administration Panel
                </h3>
            </div>
            <h4>
                Welcome {{Auth::user()->name}}!
            </h4>
            <p>You can manage</p>
            <ul>
                <li>
                    Companies
                </li>

                <li>
                    Branches
                </li>

                <li>
                    Administrators
                </li>
            </ul>
        </div>
    </div>
@endsection