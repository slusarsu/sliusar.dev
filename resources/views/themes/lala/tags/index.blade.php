@extends('themes.default.layouts.app', [
    'title' => 'Tags',
    'seoDescription' => 'Tags',
    'seoKeyWords' => 'Tags',
    'sidebar' => false,
    ])

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('tags')}}">Теги</a>
            </li>
        </ol>
    </nav>

    <div class="tagcloud">
        @foreach($tags as $tag)

            <a href="{{$tag->link()}}" class="tag-cloud-link">{{$tag->title}}</a>

        @endforeach
    </div>

@endsection
