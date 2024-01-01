@extends('themes.lala.layouts.app', [
    'sidebar' => false,
    ])

@section('content')

    @includeIf('themes.lala.partials.posts')

@endsection
