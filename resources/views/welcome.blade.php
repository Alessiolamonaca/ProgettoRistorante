<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('restaurant.name', 'RISTORANTE') }}</title>
    <meta http-equiv="refresh" content="0; url={{ url('/' . config('locales.default', 'it')) }}">
</head>
<body>
    <a href="{{ url('/' . config('locales.default', 'it')) }}">{{ config('restaurant.name', 'RISTORANTE') }}</a>
</body>
</html>