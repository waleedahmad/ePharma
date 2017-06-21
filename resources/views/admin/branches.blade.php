@extends('layout')

@section('title')
    <title>Branches - ePharm</title>
@endsection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Branches
                </h3>

                <a href="/admin/branch/add">
                    <button class="btn btn-default">Add Branch</button>
                </a>
            </div>

            <div class="branches">
                @if($branches->count())

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                Company
                            </th>

                            <th>
                                Manager
                            </th>

                            <th>
                                City
                            </th>

                            <th>
                                Town
                            </th>

                            <th>
                                Address
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Open Hours
                            </th>

                            <th>
                                Close Hours
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
                        @foreach($branches as $branch)
                            <tr class="branch">
                                <td>
                                    {{$branch->company->name}}
                                </td>

                                <td>
                                    {{$branch->manager->name}}
                                </td>

                                <td>
                                    {{$branch->loc->city->name}}
                                </td>

                                <td>
                                    {{$branch->loc->name}}
                                </td>

                                <td>
                                    {{$branch->address}}
                                </td>

                                <td>
                                    {{$branch->phone}}
                                </td>

                                <td>
                                    {{$branch->open_hours}}
                                </td>

                                <td>
                                    {{$branch->close_hours}}
                                </td>

                                <td>
                                    {{$branch->created_at->diffForHumans()}}
                                </td>

                                <td>
                                    <a href="/admin/branch/edit/{{$branch->id}}" class="btn btn-link">Edit</a>
                                    <a href="" class="btn btn-link delete-branch" data-id="{{$branch->id}}">Delete</a>
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