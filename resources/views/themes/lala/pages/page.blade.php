@extends('themes.lala.layouts.app', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
        </ol>
    </nav>

    <div class="cs-post cs-style1 cs-type1">

        @if(!empty($page->thumb()))
            <div class="cs-post__thumb">
                <div class="cs-post__thumb__in cs-bg" data-src="{{$page->thumb()}}"></div>
            </div>
        @endif

        <div class="cs-post__info">
            <div class="cs-post__meta cs-style1">
                <a href="#" class="cs-post__author"><i class="fas fa-calendar"></i>{{$page->date()}}</a>
                <div class="cs-post__view"><i class="fas fa-eye"></i>{{$page->views}}</div>
            </div>
            <h2 class="cs-post__title mb0">{{$page->title}}</h2>
            <div class="cs-post__description">
                {!! $page->content !!}
            </div>
        </div>
    </div>
    <div class="cs-height__80 cs-height__lg__40"></div>

@endsection
