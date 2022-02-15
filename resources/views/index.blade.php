<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
</head>
<body>
<p>Your session token is <code>{{ $token }}</code></p>
<p><a target="_blank" href="{{ route('registerScanner', [$token]) }}">Register as scanner</a></p>
<p><a href="{{ route('listen') }}">Do long poll</a></p>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <a href="javascript:" onclick="this.parentNode.submit()">Logout</a>
</form>
</body>
</html>
