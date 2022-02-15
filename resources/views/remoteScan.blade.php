<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
</head>
<body>
<p>Your device id is {{ $device->id }}</p>
<form action="{{ route('scans') }}" method="post">
    @csrf
    <textarea name="content">Your data</textarea>
    <input type="submit" value="Post scan"/>
</form>
</body>
</html>
