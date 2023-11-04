<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? ''}}">
        <title>{{env('APP_NAME') ?? ''}} - {{$title ?? ''}}</title>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/tokyo-night-dark.min.css">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-50">

        <x-navbar/>

        <div class="container mx-auto my-5 px-4 lg:px-0">

            @yield('content')

        </div>

    </body>
    @vite('resources/js/app.js')
</html>
