@extends('template.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <article class="bg-white border rounded p-4 text-gray-800">
        <h2 class="text-2xl font-semibold text-indigo-950 text-center">{{$post->title}}</h2>
        <p class="pt-4">{!! $post->content !!}</p>
    </article>

@endsection
