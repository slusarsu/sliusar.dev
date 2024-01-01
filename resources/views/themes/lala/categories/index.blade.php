@extends('themes.lala.layouts.app', [
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

    <div class="tagcloud">
        @foreach($categories as $category)

            <a href="{{$category->link()}}" class="tag-cloud-link">{{$category->title}}</a>

        @endforeach
    </div>

@endsection
