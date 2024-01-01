@extends('themes.lala.layouts.app', [
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('posts')}}">Дописи</a>
            </li>
        </ol>
    </nav>

    @includeIf('themes.lala.partials.posts')

@endsection
