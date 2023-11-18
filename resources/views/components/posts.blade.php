@props([
    'posts' => []
])

@if(!empty($posts))
    @foreach($posts as $post)

        <div class="card my-3">
            <div class="card-body">
                <a href="{{$post->link()}}"><h5 class="card-title">{{$post->title}}</h5></a>
                <p class="card-text">{!! $post->short !!}</p>
                <div class="d-flex justify-content-between p-2">
                    <div>
                        <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                    </div>

                    <div>
                        {{$post->date()}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{$posts->links()}}
@endif
