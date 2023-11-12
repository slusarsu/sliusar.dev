@extends('template.layouts.app', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <article class="bg-white border rounded p-4 text-gray-800">
        <h2 class="text-2xl font-semibold text-indigo-950 text-center">{{$page->title}}</h2>
        <p class="pt-4">{!! $page->content !!}</p>
    </article>

@endsection
