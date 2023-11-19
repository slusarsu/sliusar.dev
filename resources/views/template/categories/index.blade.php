@extends('template.layouts.app', [
    'title' => 'Categories',
    'seoDescription' => 'Categories',
    'seoKeyWords' => 'Categories',
    'sidebar' => false,
    ])

@section('content')

    <div class="d-flex gap-2">
        @foreach($categories as $category)

            <a href="{{$category->link()}}">
                <h2>
                    <span class="badge bg-secondary">{{$category->title}}</span>
                </h2>
            </a>

        @endforeach
    </div>

@endsection
