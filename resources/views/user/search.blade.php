@extends('layout')

@section('title')
    <title>{{$query}} Search Results - ePharma</title>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h4>
                <b>{{$query}}</b> Search Results
            </h4>
        </div>

        <div class="results">
            @if($medicines->count())
                @foreach($medicines as $medicine)
                    @if($medicine->stock->count())
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <b>{{$medicine->branch->company->name}} - {{$medicine->branch->address}}, {{$medicine->branch->loc->name}}, {{$medicine->branch->loc->city->name}}</b>
                                </h4>
                            </div>
                            <div class="panel-body">

                                    @foreach($medicine->stock as $stock)
                                    <table class="table table-bordered">

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
                                    <a href="/medicine/{{$stock->id}}"><button class="btn btn-default pull-right">View Details</button></a>
                                    <br>
                                    @endforeach
                            </div>
                        </div>
                    @endif

                @endforeach
            @else
                No medicines found.
            @endif
        </div>
    </div>
@endsection