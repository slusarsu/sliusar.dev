@extends('themes.lala.layouts.app', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Головна</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('posts')}}">Дописи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
        </ol>
    </nav>

    <div class="cs-post cs-style1 cs-type1">

        @if(!empty($post->thumb()))
            <div class="cs-post__thumb">
                <div class="cs-post__thumb__in cs-bg" data-src="{{$post->thumb()}}"></div>
            </div>
        @endif

        <div class="cs-post__info">
            <div class="cs-post__meta cs-style1">
                <a href="#" class="cs-post__author"><i class="fas fa-calendar"></i>{{$post->date()}}</a>
                <div class="cs-post__view"><i class="fas fa-eye"></i>{{$post->views}}</div>
                @if(!empty($post->category))
                    <a href="{{$post->category->link()}}" class="rt-post__comment">
                        <i class="fas fa-layer-group"></i> {{$post->category->title}}
                    </a>
                @endif
            </div>
            <h2 class="cs-post__title mb0">{{$post->title}}</h2>
            <div class="cs-post__description">
                {!! $post->content !!}
            </div>
        </div>
    </div>

    <div class="cs-post__info mt-3">
        <form action="{{route('add-comment')}}" method="POST" class="cs-form cs-style2">
            @csrf

            <input type="hidden" name="record_id" value="{{$post->id}}">
            <input type="hidden" name="model" value="{{get_class($post)}}">
            <input type="hidden" name="parent_id" value="">

            <div class="row">
                <div class="col-sm-12">
                    <input type="email" class="cs-form__field" name="email" placeholder="Email Address" required="">
                    <div class="cs-height__25 cs-height__lg__25"></div>
                </div>

                <div class="col-sm-12">
                    <textarea class="cs-form__field" name="content" placeholder="Write Comment" required=""></textarea>
                    <div class="cs-height__25 cs-height__lg__25"></div>
                </div>
                <div class="col-lg-12">
                    <button class="cs-btn cs-style1 cs-color1 cs-primary__font w-100" type="submit">Submit Now</button>
                </div>
            </div>
        </form>
    </div>

    @if(!empty($post->comments))
        <div class="widget">
            <div class="widget-body my-3">
                <div class="widget-list">
                    @foreach($post->comments as $comment)
                        @if($comment->is_enabled)
                            <div class="media align-items-center" id="comment-{{$comment->id}}">
                                <div class="media-body ml-3">
                                    <h3 style="margin-top:-5px">{{$comment->emailName()}}</h3>
                                    <p class="mb-0">{{$comment->content}}</p>
                                    <div class="text-right my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                            <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                        </svg> <span>{{$comment->date()}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>

        </div>
    @endif

    <div class="cs-height__80 cs-height__lg__40"></div>

@endsection
