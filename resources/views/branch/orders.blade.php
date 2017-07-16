@extends('layout')

@section('title')
    <title>Orders - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Orders
                </h3>
            </div>

            <div class="orders">
                @if($orders->count())

                    <table class="table table">
                        <thead>
                        <tr>
                            <th>
                                ID #
                            </th>

                            <th>
                                Customer Name
                            </th>

                            <th>
                                Customer Address
                            </th>

                            <th>
                                Total Items
                            </th>

                            <th>
                                Order Date
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($orders as $order)
                            <tr class="order">
                                <td>
                                    {{$order->id}}
                                </td>

                                <td>
                                    {{$order->user->name}}
                                </td>

                                <td>
                                    {{$order->user->info->address}}, {{$order->user->info->town->name}} {{$order->user->info->town->city->name}}
                                </td>

                                <td>
                                    {{$order->items->count()}}
                                </td>

                                <td>
                                    {{$order->created_at}}
                                </td>

                                <td>
                                    {{($order->cleared) ? 'Cleared' : 'Pending'}}
                                </td>

                                <td>
                                    <a href="/branch/order/{{$order->id}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No orders available.
                @endif
            </div>
        </div>
    </div>
@endsection