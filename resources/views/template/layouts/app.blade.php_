<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{$seoDescription ?? $settings['seo_description'] ?? ''}}">
        <meta name="keywords" content="{{$seoKeyWords ?? $settings['seo_text_keys'] ?? ''}}">
        <title>{{$settings['site_name'] ?? ''}} - {{$title ?? $settings['seo_title'] ?? ''}}</title>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/tokyo-night-dark.min.css">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-50">

        <x-navbar/>

        <div
            @class([
                'container mx-auto my-5 px-4 lg:px-0' => empty($sidebar),
                'container mx-auto my-5 px-4 lg:px-0 grid grid-cols-1 gap-y-4 lg:grid-cols-4 lg:gap-4' => !empty($sidebar),
            ])
        >

            <div class="col-span-3">
                @yield('content')
            </div>
            @if(!empty($sidebar))
                <div class="col-span-1">
                    <div class="bg-white border rounded p-4 text-gray-800">
                        <h2>Category</h2>
                    </div>
                </div>
            @endif
        </div>

    </body>
    @vite('resources/js/app.js')
</html>
