@extends('themes.default.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('posts')}}">Дописи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h1 class="display-6">{{$post->title}}</h1>
        </div>
        <div class="card-body">

            <p class="card-text">
                {!! $post->content !!}
            </p>

            <div class="d-flex justify-content-between p-2">
                <div>
                    @if(!empty($post->category))
                        <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <div>
                        <i class="bi bi-eye"></i> {{$post->views}}
                    </div>

                    <div>
                        <i class="bi bi-calendar-check-fill"></i>
                        {{$post->date()}}
                    </div>

                </div>
            </div>

            <dv>
                @foreach($post->tags as $tag)

                    <a href="{{$tag->link()}}">
                        <span class="badge bg-secondary">
                            <i class="bi bi-tag-fill"></i>
                            {{$tag->title}}
                        </span>
                    </a>

                @endforeach
            </dv>

        </div>
    </div>

@endsection
