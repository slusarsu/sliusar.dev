@extends('template.layouts.app', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$page->title}}</h5>
            <p class="card-text">
                {!! $page->content !!}
            </p>
        </div>
    </div>

@endsection
