@extends('template.layouts.app',[
    'sidebar' => true,
 ])

@section('content')

    <x-posts :posts="$posts"/>

@endsection
