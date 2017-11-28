<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
</head>
<body>
<div id="app">
    <custom-menu></custom-menu>
    @if (Auth::check())
        <clients></clients>
    @else
        <a href="/login">Login in</a>
        <br>or<br>
        <a href="/register">Register</a>
    @endif
</div>
<script src="{{asset("js/app.js")}}"></script>
</body>
</html>
