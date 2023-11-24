@props([
    'posts' => []
])

@if(!empty($posts))
    @foreach($posts as $post)

        <div class="card my-3">
            <div class="card-body">
                <a href="{{$post->link()}}">
                    <h3 class="card-title">{{$post->title}}</h3>
                </a>
                <p class="card-text">{!! $post->short !!}</p>
                <div class="d-flex justify-content-between p-2">
                    <div>
                        @if(!empty($post->category))
                            <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <div>
                            <i class="bi bi-eye"></i> {{$post->views}}
                        </div>

                        <div>
                            <i class="bi bi-calendar-check-fill"></i>
                            {{$post->date()}}
                        </div>

                    </div>
                </div>

                <dv>
                    @foreach($post->tags as $tag)

                        <a href="{{$tag->link()}}">
                                <span class="badge bg-secondary">
                                    <i class="bi bi-tag-fill"></i>
                                    {{$tag->title}}
                                </span>
                        </a>

                    @endforeach
                </dv>
            </div>
        </div>
    @endforeach

    @if(method_exists($posts, 'links'))
        {!! $posts->appends(Request::except('page'))->render() !!}
    @endif
@endif
