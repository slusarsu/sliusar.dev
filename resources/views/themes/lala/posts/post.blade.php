@extends('themes.lala.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('posts')}}">Дописи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>

    <div class="cs-post cs-style1 cs-type1">

        @if(!empty($post->thumb()))
            <div class="cs-post__thumb">
                <div class="cs-post__thumb__in cs-bg" data-src="{{$post->thumb()}}"></div>
            </div>
        @endif

        <div class="cs-post__info">
            <div class="cs-post__meta cs-style1">
                <a href="#" class="cs-post__author"><i class="fas fa-calendar"></i>{{$post->date()}}</a>
                <div class="cs-post__view"><i class="fas fa-eye"></i>{{$post->views}}</div>
                @if(!empty($post->category))
                    <a href="{{$post->category->link()}}" class="rt-post__comment">
                        <i class="fas fa-layer-group"></i> {{$post->category->title}}
                    </a>
                @endif
            </div>
            <h2 class="cs-post__title mb0">{{$post->title}}</h2>
            <div class="cs-post__description">
                {!! $post->content !!}
            </div>
        </div>
    </div>
    <div class="cs-height__80 cs-height__lg__40"></div>

@endsection
