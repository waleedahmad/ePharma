@extends('layout')

@section('title')
    <title>ePharma</title>
@endsection

@section('content')
    <div class="container">
        @if(!Auth::user()->info)
            <div class="alert alert-success">
                Please fill in <a href="/user/info" class="alert-link">Contact Details</a> to use checkout feature.
            </div>
        @endif

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
        @endif

        <div class="products">
            <div class="user-sidebar col-xs-12 col-sm-12 col-md-3 col-lg-2">
                <div class="page-header">
                    <h4>
                        Categories
                    </h4>
                </div>

                @include('user.sidebar')
            </div>

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10">
                <div class="page-header">
                    <h4>
                        Featured Products
                    </h4>
                </div>

                <div class="featured">
                    @if($products->count())
                        <div class="row">
                            @foreach($products as $product)
                                <a href="/medicine/{{$product->id}}">
                                    <div class="col-sm-6 col-md-4 col-lg-3 product">
                                        <div class="thumbnail">
                                            <div class="image-holder">
                                                <img src="/storage/{{$product->image_uri}}" alt="...">
                                            </div>
                                            <div class="caption">
                                                <h3>{{$product->medicine->name}} <small>{{$product->type}}</small></h3>
                                                <p>
                                                    <b>Potency</b> {{$product->potency}} mg
                                                </p>
                                                <p><b>Price Rs.</b> {{$product->price}}</p>

                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>

                    @else
                        <div class="alert alert-info">
                            No products available at stores near your current location.
                            You can change your location <a href="/user/info" class="alert-link">here</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection