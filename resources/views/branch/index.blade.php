@extends('layout')

@section('title')
    <title>Branch Admin - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Branch Administration - {{$branch->address }}, {{$branch->loc->name}}, {{$branch->loc->city->name}}
                </h3>
            </div>
            <h3>

            </h3>

            <h4>
                Welcome {{Auth::user()->name}}!
            </h4>
            <p>You can manage your branch's</p>
            <ul>
                <li>
                    Medicines
                </li>

                <li>
                    Medicine Stock
                </li>

                <li>
                    Orders
                </li>
            </ul>
        </div>
    </div>
@endsection