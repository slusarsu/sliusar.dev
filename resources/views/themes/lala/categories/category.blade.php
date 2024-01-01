@extends('themes.lala.layouts.app', [
    'title' => $category->seo_title ?? $category->title,
    'seoDescription' => $category->seo_description,
    'seoKeyWords' => $category->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    @includeIf('themes.lala.partials.posts')

@endsection
