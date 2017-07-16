@extends('layout')

@section('title')
    <title>ePharma</title>
@endsection

@section('content')
    <div class="welcome">
        <div class="title">
            <h1>ePharma</h1>
        </div>

        <div class="description">
            Find cheapest medicine in your area
        </div>

        <div class="search">
            <form method="GET" action="/search">
                <input type="text" class="form-control" placeholder="Search Medicines" name="medicine">
            </form>
        </div>

        <div class="actions">
            <a href="/register">
                <button class="btn btn-default">
                    Register
                </button>
            </a>

            <a href="/login">
                <button class="btn btn-default">
                    Login
                </button>
            </a>
        </div>
    </div>
@endsection