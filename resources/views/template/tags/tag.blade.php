@extends('template.layouts.app', [
    'title' => $tag->title,
    'seoDescription' => $tag->title,
    'seoKeyWords' => $tag->title,
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('tags')}}">Tags</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$tag->title}}</li>
        </ol>
    </nav>

    <x-posts :posts="$posts"/>
@endsection
