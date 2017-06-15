@extends('layout')

@section('title')
    <title>Users</title>
@endsection

@section('content')

    <div class="user col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <input type="text" class="pull-right form-control search" placeholder="Search">

        <div class="spaces"></div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        UserName
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Contact
                    </th>
                    <th>
                        CNIC
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Location
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($user as $usr)
                <tr class="users-row">

                    <td>
                        {{$usr->name}}
                    </td>

                    <td>
                        {{$usr->email}}
                    </td>

                    <td>
                        {{$usr->contact}}
                    </td>

                    <td>
                        {{$usr->CNIC}}
                    </td>

                    <td>
                        {{$usr->type}}
                    </td>

                    <td>
                        {{$usr->address}}
                    </td>
                    <td>
                        <a data-id="{{$usr->id}}" class="delete-users">Delete</a> {{--/
                        <a href="/user/edit/{{$brnch->id}}">Edit </a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection