@props([
    'posts' => []
])

@if(!empty($posts))

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 ">
        @foreach($posts as $post)

            <artile class="bg-white border border-2 rounded p-4">
                <div class="p-1 text-gray-800">
                    <a href="{{$post->link()}}">
                        <h2 class="text-2xl font-semibold text-indigo-950">{{$post->title}}</h2>
                    </a>

                    <p class="p-3">{!! $post->short !!}</p>

                </div>
                <div class="flex justify-between">
                    <div class="p-2">
                        {{$post->date()}}
                    </div>

                    <div class="p-2">
                        <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                    </div>
                </div>

            </artile>

        @endforeach

    </div>

    <div class="mt-2">
        {{ $posts->links() }}
    </div>

@endif
