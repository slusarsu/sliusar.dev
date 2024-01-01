@extends('themes.default.layouts.app', [
    'title' => 'Categories',
    'seoDescription' => 'Categories',
    'seoKeyWords' => 'Categories',
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('categories')}}">Категорії</a>
            </li>
        </ol>
    </nav>

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
