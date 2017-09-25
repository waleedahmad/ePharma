@extends('layout')

@section('title')
    <title>Order # {{$order->id}} - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h3>
                Order # {{$order->id}}
            </h3>

            <p>
                {{$order->branch->company->name . ' - ' . $order->branch->address . ', ' . $order->branch->loc->name . ', '. $order->branch->loc->city->name}}
            </p>

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
    </div>
@endsection