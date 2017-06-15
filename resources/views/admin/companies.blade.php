@extends('layout')

@section('title')
    <title>Companies - ePharm</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Companies
                </h3>

                <a href="/admin/company/add">
                    <button class="btn btn-default">Add Company</button>
                </a>
            </div>

            <div class="companies">
                @if($companies->count())

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Address
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
                        @foreach($companies as $company)
                            <tr class="company">
                                <td>
                                    {{$company->name}}
                                </td>

                                <td>
                                    {{$company->email}}
                                </td>

                                <td>
                                    {{$company->phone}}
                                </td>

                                <td>
                                    {{$company->address}}
                                </td>

                                <td>
                                    {{$company->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <a href="/admin/company/edit/{{$company->id}}" class="btn btn-link">Edit</a>
                                    <a href="" class="btn btn-link delete-company" data-id="{{$company->id}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    No companies available.
                @endif
            </div>
        </div>
    </div>
@endsection