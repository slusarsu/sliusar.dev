<div class="nav-bar bg-body-tertiary mb-3">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">
                    {{$settings['site_name'] ?? ''}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @foreach(menuPositionLinks('top') as $link)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{$link['url']}}">
                                    {{$link['text']}}
                                </a>
                            </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Категорії
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(categories() as $category)
                                    <li><a class="dropdown-item" href="{{$category->link()}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <form action="{{route('post-search')}}">
                        <input class="form-control me-2" type="search" placeholder="Пошук" aria-label="Пошук" name="s">
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
