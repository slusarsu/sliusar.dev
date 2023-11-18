@extends('template.layouts.main', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    ])

@section('content')

    <div class="card">
        <div class="card-header pb-0">
            <a href="{{$post->link()}}">
                <h5>{{$post->title}}</h5>
            </a>
        </div>
        <div class="card-body">
            <p>{!! $post->content !!}</p>
        </div>

        <div class="d-flex">
            <div class="p-2">
                {{$post->date()}}
            </div>

            <div class="p-2">
                <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
            </div>
        </div>
    </div>

@endsection
