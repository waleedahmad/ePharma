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
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="image-holder">
                        <img src="/storage/{{$stock->image_uri}}" alt="">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9">
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
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/cart" method="POST">
                        <div class="col-xs-3 details">
                            <b>Price :</b> Rs. {{$stock->price}}
                        </div>

                        <div class="col-xs-3 details">
                            <b>Items in Stock :</b> {{$stock->quantity}}
                        </div>

                        <div class="col-xs-3">
                            <div class="col-xs-4 details">
                                <b>
                                    Quantity :
                                </b>
                            </div>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Required Quantity" name="quantity">
                            </div>
                        </div>

                        {{csrf_field()}}

                        <input type="hidden" name="medicine_id" value="{{$stock->id}}">

                        <div class="col-xs-3">
                            <button class="btn btn-default pull-right" id="{{$stock->id}}">Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection