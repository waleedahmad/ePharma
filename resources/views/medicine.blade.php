@extends('layout')

@section('title')
    <title>{{$stock->medicine->name}} - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                {{$stock->medicine->name}}
            </h4>
        </div>

        <div class="stock-item">
            <table class="table table-bordered">

                <tr>
                    <td>
                        <b>Location</b>
                    </td>

                    <td>
                        {{$stock->medicine->branch->address}}, {{$stock->medicine->branch->loc->name}}, {{$stock->medicine->branch->loc->city->name}}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Name</b>
                    </td>

                    <td>
                        {{$stock->medicine->name}}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Category</b>
                    </td>

                    <td>
                        {{$stock->category}}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Type</b>
                    </td>

                    <td>
                        {{$stock->type}}
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Potency</b>
                    </td>

                    <td>
                        {{$stock->potency}} mg
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Availability</b>
                    </td>

                    <td>
                        @if($stock->quantity)
                            In Stock
                        @else
                            Out of Stock
                        @endif
                    </td>
                </tr>
            </table>
            <button class="btn btn-default pull-right add-cart" id="{{$stock->id}}">Add to Cart</button>
        </div>
    </div>
@endsection