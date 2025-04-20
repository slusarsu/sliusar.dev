<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? $settings['seo_description'] ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? $settings['seo_text_keys'] ?? ''}}">
        <title>{{$title . '-' ?? $settings['seo_title'] . '-' ?? ''}} {{$settings['site_name'] ?? ''}}</title>

        @include('themes.default.partials.header-scripts')

        {!! $settings['header_codes'] ?? ''!!}

    </head>
    <body>

        @include('themes.default.partials.navbar')

        <div class="container">
            @yield('content')

            @include('themes.default.partials.footer')
        </div>

        @include('themes.default.partials.footer-scripts')
    </body>

</html>
