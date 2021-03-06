<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="token" content="{{csrf_token()}}">                                                
    @yield('title')
    <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/libs/jquery-ui/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/app.min.css">
</head>
    <body @if(Request::path() === '/' && !Auth::check()) class="cover" @endif>
        @include('nav')
        @yield('content')
        <script src="/libs/jquery/dist/jquery.min.js"></script>
        <script src="/libs/jt.timepicker/jquery.timepicker.js"></script>
        <script src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/libs/bootbox.js/bootbox.js"></script>
        <script src="/libs/jquery-ui/jquery-ui.min.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>