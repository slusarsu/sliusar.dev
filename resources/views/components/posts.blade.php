@props([
    'posts' => []
])

@if(!empty($posts))

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-header pb-0">
                            <a href="{{$post->link()}}">
                                <h5>{{$post->title}}</h5>
                            </a>
                        </div>
                        <div class="card-body">
                            <p>{!! $post->short !!}</p>
                        </div>

                        <div class="d-flex">
                            <div class="p-2">
                                {{$post->date()}}
                            </div>

                            <div class="p-2">
                                <a href="{{$post->category->link()}}">{{$post->category->title}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endif
