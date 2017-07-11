@extends('layout')

@section('title')
    <title>Receipts # {{$receipt->id}} - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                <a href="/receipts"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a> Receipt # {{$receipt->id}}
            </h4>
        </div>

        <div class="receipts">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>
                        Medicine Name
                    </th>

                    <th>
                        Ordered Quantity
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
                @foreach($receipt->transactions as $item)
                    <tr class="receipt">
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
                            Rs. {{$item->price}}
                        </td>

                        <td>
                            {{$item->potency}}
                        </td>

                        <td>
                            {{$item->type}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart-checkout">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-xs-6 details">
                        <b>Total Rs.  : </b> {{$receipt->total()}}
                    </div>

                    <div class="col-xs-6 details">
                        <b>Receipt Date  : </b> {{$receipt->created_at}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection