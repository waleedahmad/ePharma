@extends('layout')

@section('title')
    <title>Checkout - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                Checkout
            </h4>
        </div>

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif

        @if(Session::has('order_failed'))
            <div class="alert alert-danger">
                <div>
                    <h4>
                        <b>Checkout Failed</b>
                    </h4>
                </div>

                <div>
                    Following orders to stores didn't meet minimum order amount criteria.
                </div>

                <div>
                    <ul>
                        @foreach(Session::get('failed') as $store)
                            <li>
                                {{$store}}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <b>Minimum order : </b> {{env('MINIMUM_ORDER')}}
                </div>
            </div>
        @endif

        @if(!Auth::user()->info)
            <div class="alert alert-success">
                Please fill in <a href="/user/info" class="alert-link">Contact Details</a> to use checkout feature.
            </div>
        @endif

        <div class="cart">
            @if($items->count())

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            Medicine Name
                        </th>

                        <th>
                           Order Quantity
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Potency
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Store
                        </th>

                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $item)
                        <tr class="cart-item">
                            <td>
                                {{$item->stock->medicine->name}}
                            </td>

                            <td>
                                {{$item->quantity}}
                            </td>

                            <td>
                                {{$item->stock->category}}
                            </td>

                            <td>
                                {{$item->stock->price}}
                            </td>

                            <td>
                                {{$item->stock->potency}} mg
                            </td>

                            <td>
                                {{$item->stock->type}}
                            </td>

                            <td>
                                {{$item->stock->medicine->branch->company->name}} -
                                {{$item->stock->medicine->branch->address}},
                                {{$item->stock->medicine->branch->loc->name}},
                                {{$item->stock->medicine->branch->loc->city->name}}
                            </td>

                            <td>
                                <a href="" class="btn btn-link rm-cart-item" data-id="{{$item->id}}">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                You haven't added any medicines in your cart.
            @endif
        </div>

        @if($items->count())
            <div class="cart-checkout">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-xs-6 details">
                            <b>Total Rs.  : </b> {{$total}}
                        </div>

                        <div class="col-xs-6">
                            <a href="/cart/process" class="confirm-checkout">
                                <button class="btn btn-default pull-right">Confirm Checkout</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection