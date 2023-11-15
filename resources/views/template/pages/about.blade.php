@extends('template.layouts.app', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
    'sidebar' => true,
    ])

@section('content')

    <article class="bg-white border rounded p-4 text-gray-800">

        <h2 class="text-2xl font-semibold text-indigo-950 text-center mb-5">
            {{$page->title}}
        </h2>

        <div class="w-56 h-56 lg:w-64 lg:h-64 mx-auto">
            <img
                class="rounded-full border border-gray-100 shadow-sm"
                src="{{$page->thumb()}}"
                alt="user image"
            />
        </div>

        <div class="p-4 mt-4">
            {!! $page->content !!}
        </div>

        <h3 class="text-2xl font-semibold text-indigo-950 text-center mb-5">
            Jobs
        </h3>


        @foreach($page->custom_fields['jobs'] as $job)
            <div class="bg-white border-2 rounded p-4">
                {{$job['company']}}
            </div>
        @endforeach

{{--        @dd($page->custom_fields['jobs'])--}}




    </article>

@endsection
