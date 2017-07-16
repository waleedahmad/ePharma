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
    </div>
@endsection