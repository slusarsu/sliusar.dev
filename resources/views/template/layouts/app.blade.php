<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? $settings['seo_description'] ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? $settings['seo_text_keys'] ?? ''}}">
        <title>{{$settings['site_name'] ?? ''}} - {{$title ?? $settings['seo_title'] ?? ''}}</title>
        <link rel="stylesheet" href="{{asset('template/lib/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/tokyo-night-dark.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{asset('template/css/main.css')}}">

        {!! $settings['header_codes'] ?? ''!!}

    </head>
    <body>

        <x-navbar :hash="$settings['navbar_menu_hash'] ?? ''"/>

        <div class="container">
            @yield('content')

            @include('template.partials.footer')
        </div>
        <script src="{{asset('template/lib/bootstrap/js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('template/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('template/js/popper.min.js')}}"></script>
        <script src="{{asset('template/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>
    </body>

</html>
