@extends('themes.default.layouts.app')

@section('content')

    <x-posts :posts="$posts"/>

@endsection
