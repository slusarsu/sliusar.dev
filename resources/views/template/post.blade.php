@extends('template.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    ])

@section('content')

    <div class="card">
        <div class="card-header">
            {{$post->title}}
        </div>
        <div class="card-body">

            <p class="card-text">
                {!! $post->content !!}
            </p>

            <div class="d-flex justify-content-between p-2">
                <div>
                    <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                </div>

                <div>
                    {{$post->date()}}
                </div>
            </div>
        </div>
    </div>

@endsection
