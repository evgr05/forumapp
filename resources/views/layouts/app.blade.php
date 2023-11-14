<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container sections-wrapper">
    <div class="row">
        <div class="primary col-md-8 col-sm-12 col-xs-12">
            @yield('content')
        </div>
        <div class="secondary col-md-4 col-sm-12 col-xs-12">
            @include('layouts.aside')
        </div>
    </div>
</div>
<footer class="footer">
</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
