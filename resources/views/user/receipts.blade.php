@extends('layout')

@section('title')
    <title>Receipts - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                Your Receipts
            </h4>
        </div>

        <div class="receipts">
            @if($receipts->count())
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            Receipt ID #
                        </th>

                        <th>
                            Ordered Items
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Receipt Date
                        </th>

                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($receipts as $receipt)
                        <tr class="receipt">
                            <td>
                                {{$receipt->id}}
                            </td>

                            <td>
                                {{$receipt->transactions->count()}}
                            </td>

                            <td>
                                Rs. {{$receipt->total()}}
                            </td>

                            <td>
                                {{$receipt->created_at}}
                            </td>

                            <td>
                                <a href="/receipt/{{$receipt->id}}">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                You currently have no orders.
            @endif

        </div>

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
                            Store Location
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
                                {{$order->branch->company->name . ' - ' . $order->branch->address . ', ' . $order->branch->loc->name . ', '. $order->branch->loc->city->name}}
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
                                <a href="/order/{{$order->id}}">View</a>
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
@endsection