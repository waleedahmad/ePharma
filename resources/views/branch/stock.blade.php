@extends('layout')

@section('title')
    <title>Medicine Stock - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Medicines Stock
                </h3>

                <a href="/branch/stock/add">
                    <button class="btn btn-default">Add Stock</button>
                </a>
            </div>

            <div class="stock">
                @if($stock->count())

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Medicine Name
                            </th>

                            <th>
                                Quantity
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
                                Quantity
                            </th>

                            <th>
                                Mfg Date
                            </th>

                            <th>
                                Expiry Date
                            </th>

                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($stock as $item)
                            <tr class="item">
                                <td>
                                    {{$item->medicine->name}}
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
                                    {{$item->potency}}
                                </td>

                                <td>
                                    {{$item->type}}
                                </td>

                                <td>
                                    {{$item->mfg_date}}
                                </td>

                                <td>
                                    {{$item->expiry}}
                                </td>

                                <td>
                                    <a href="/branch/stock/edit/{{$item->id}}" class="btn btn-link">Edit</a>
                                    <a href="" class="btn btn-link delete-stock" data-id="{{$item->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No stock available.
                @endif
        </div>
    </div>
    </div>
@endsection