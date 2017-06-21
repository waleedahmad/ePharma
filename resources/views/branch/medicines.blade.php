@extends('layout')

@section('title')
    <title>Medicines - ePharma</title>
@endsection

@section('content')
    <div class="admin">
        @include('branch.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Medicines
                </h3>

                <a href="/branch/medicine/add">
                    <button class="btn btn-default">Add Medicine</button>
                </a>
            </div>

            <div class="medicines">
                @if($medicines->count())

                    <table class="table table">
                        <thead>
                        <tr>
                            <th>
                                Name
                            </th>

                            <th>
                                Added
                            </th>

                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($medicines as $medicine)
                            <tr class="medicine">
                                <td>
                                    {{$medicine->name}}
                                </td>

                                <td>
                                    {{$medicine->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <a href="/branch/medicine/edit/{{$medicine->id}}" class="btn btn-link">Edit</a>
                                    <a href="" class="btn btn-link delete-medicine" data-id="{{$medicine->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No medicines available.
                @endif
            </div>
        </div>
    </div>
@endsection