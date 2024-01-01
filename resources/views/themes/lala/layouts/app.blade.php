<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? $settings['seo_description'] ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? $settings['seo_text_keys'] ?? ''}}">
        <title>{{$settings['site_name'] ?? ''}} - {{$title ?? $settings['seo_title'] ?? ''}}</title>

        @include('themes.lala.partials.header-scripts')

        {!! $settings['header_codes'] ?? ''!!}

    </head>
    <body>

        @include('themes.lala.partials.header')


        <div>
            <div class="cs-height__130 cs-height__lg__70"></div>
            <div class="container">
                <div class="row">

                    @if(!empty($sidebar))
                        <div class="col-lg-4">
                            @include('themes.lala.partials.sidebar')
                        </div>
                    @endif

                    <div class="@if(!empty($sidebar)) col-lg-8 @else col-12 @endif">
                        @yield('content')
                    </div>

                </div>
            </div>
            <div class="cs-height__130 cs-height__lg__80"></div>
        </div>

        @include('themes.lala.partials.footer')


        @include('themes.lala.partials.footer-scripts')
    </body>

</html>
