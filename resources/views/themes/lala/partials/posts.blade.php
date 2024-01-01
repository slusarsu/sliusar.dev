@if(!empty($posts))
    @foreach($posts as $post)

        <div class="cs-post cs-style1 cs-type1">
            @if(!empty($post->thumb()))
                <a href="{{$post->link()}}" class="cs-post__thumb">
                    <div class="cs-post__thumb__in cs-bg" data-src="{{$post->thumb()}}"></div>
                </a>
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

                <h2 class="cs-post__title mb0">
                    <a href="{{$post->link()}}">
                        {{$post->title}}
                    </a>
                </h2>

                <div class="cs-post__subtitle">
                    {!! $post->short !!}
                </div>

                <div class="cs-post__btn">
                    <div class="tagcloud">
                        @foreach($post->tags as $tag)
                            <a href="{{$tag->link()}}" class="tag-cloud-link">{{$tag->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="cs-height__40 cs-height__lg__40"></div>
    @endforeach



    @if(method_exists($posts, 'links'))

        <div class="cs-post__pagination cs-style1">
            <ul class="page-numbers">
                @foreach($posts->appends(Request::except('page'))->toArray()['links'] as $paginationItem)

                    <li>
                        <a class="page-numbers @if($paginationItem['active']) current @endif" href="{{$paginationItem['url']}}">
                            {!! $paginationItem['label'] !!}
                        </a>
                    </li>

                @endforeach
            </ul>
        </div>

    @endif
@endif
