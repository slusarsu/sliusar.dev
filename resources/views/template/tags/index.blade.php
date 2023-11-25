@extends('template.layouts.app', [
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

    <div class="d-flex gap-2">
        @foreach($tags as $tag)

            <a href="{{$tag->link()}}">
                <h2>
                    <span class="badge bg-secondary">
                        <i class="bi bi-tag-fill"></i>
                        {{$tag->title}}
                    </span>
                </h2>
            </a>

        @endforeach
    </div>

@endsection
