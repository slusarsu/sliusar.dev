@extends('themes.default.layouts.app', [
    'title' => $category->seo_title ?? $category->title,
    'seoDescription' => $category->seo_description,
    'seoKeyWords' => $category->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
        </ol>
    </nav>

    <x-posts :posts="$posts"/>
@endsection
