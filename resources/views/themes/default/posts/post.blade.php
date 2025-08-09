@extends('themes.default.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('posts')}}">Дописи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h1 class="display-6">{{$post->title}}</h1>
        </div>
        <div class="card-body">

            <p class="card-text">
                {!! $post->content !!}
            </p>

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

            <div class="card mt-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Leave a Comment</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('add-comment')}}" method="POST">
                        @csrf
                        <input type="hidden" name="record_id" value="{{$post->id}}">
                        <input type="hidden" name="model" value="{{get_class($post)}}">
                        <input type="hidden" name="parent_id" value="">

                        @guest
                            <div class="mb-3">
                                <label for="commentEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="commentEmail" name="email" placeholder="Email Address" required>
                            </div>
                        @else
                            <input type="hidden" class="form-control" id="commentEmail" name="email" placeholder="Email Address" value="{{auth()->user()->email}}">
                        @endguest
                        <div class="mb-3">
                            <label for="commentContent" class="form-label">Your Comment</label>
                            <textarea class="form-control" id="commentContent" name="content" rows="3" placeholder="Write Comment" required></textarea>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Submit Now</button>
                    </form>
                </div>
            </div>

            @if(!empty($post->comments))
                <div class="mt-5">
                    <h5 class="mb-4">Comments</h5>
                    @foreach($post->comments as $comment)
                        @if($comment->is_enabled)
                            <div class="card mb-3 shadow-sm" id="comment-{{$comment->id}}">
                                <div class="card-body d-flex">
                                    <div class="flex-shrink-0">
                                        <span class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;font-size:1.2rem;">
                                            <i class="bi bi-person"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">{{$comment->emailName()}}</h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar-check-fill me-1"></i>{{$comment->date()}}
                                            </small>
                                        </div>
                                        <p class="mb-0 mt-2">{{$comment->content}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

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

@endsection
