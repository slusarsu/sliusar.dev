
@extends('themes.default.layouts.app', [
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

    <div class="card">
        <div class="card-header">
            {{$page->title}}
        </div>
        <div class="card-body">
            <p class="card-text">
                {!! $page->content !!}
            </p>

            <form action="{{route('adm-form', 'x7ZB4o0bPQg8627')}}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Name">
                <input type="submit" value="save">
            </form>
        </div>
    </div>

@endsection
