@extends('template.layouts.app', [
    'title' => 'Tags',
    'seoDescription' => 'Tags',
    'seoKeyWords' => 'Tags',
    'sidebar' => false,
    ])

@section('content')
    <div class="d-flex gap-2">
        @foreach($tags as $tag)

            <a href="{{$tag->link()}}">
                <h2>
                    <span class="badge bg-secondary">{{$tag->title}}</span>
                </h2>
            </a>

        @endforeach
    </div>

@endsection
