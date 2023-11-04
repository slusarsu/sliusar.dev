@extends('template.layouts.app')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 ">
        @foreach($posts as $post)
            <a href="{{$post->link()}}" class="bg-white border border-2 rounded p-4">
                <div class="p-1 text-gray-800">
                    <h2 class="text-2xl font-semibold text-indigo-950">{{$post->title}}</h2>
                    <p>{!! $post->short !!}</p>
                </div>
            </a>

        @endforeach

    </div>

    <div class="mt-2">
        {{ $posts->links() }}
    </div>

@endsection
