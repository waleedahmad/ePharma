@extends('layout')

@section('title')
    <title>Orders # {{$order->id}} - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Orders # {{$order->id}}
                </h3>

                <a href="/branch/orders">
                    <button class="btn btn-default">Back to Orders</button>
                </a>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

            <div class="orders">
                @if($order->items->count())

                    <table class="table table">
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
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($order->items as $item)
                            <tr class="order">
                                <td>
                                    {{$item->medicine_name}}
                                </td>

                                <td>
                                    {{$item->quantity}}
                                </td>

                                <td>
                                    {{$item->category}}
                                </td>

                                <td>
                                    {{$item->price}}
                                </td>

                                <td>
                                    {{$item->potency}} mg
                                </td>

                                <td>
                                    {{$item->type}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No items in this order.
                @endif
            </div>

            @if($order->items->count())
                <div class="order-details">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="col-xs-6 details">
                                <b>Total Rs.  : </b> {{$order->total()}}
                            </div>

                            @if(!$order->cleared)
                                <div class="col-xs-6">
                                    <a href="/branch/order/{{$order->id}}/clear" class="clear-order">
                                        <button class="btn btn-default pull-right">Clear Order</button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection