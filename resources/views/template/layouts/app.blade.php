<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? ''}}">
        <title>{{env('APP_NAME') ?? ''}} - {{$title ?? ''}}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @yield('content')
    </body>
</html>
