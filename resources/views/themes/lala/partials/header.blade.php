<div class="cs-preloader">
    <div class="cs-preloader__in">
        <img src="{{asset('themes/lala/assets/img/loader.png')}}" alt="">
    </div>
</div>
<!-- Start Header Section -->
<header class="cs-site__header cs-style1 cs-color1">
    <div class="cs-main__header">
        <div class="container">
            <div class="cs-main__header__in">
                <div class="cs-main__header__left">
                    <a href="/">
{{--                        <img src="{{asset('themes/lala/assets/img/logo-icon.svg')}}" alt="Lala">--}}
                        <h2 class="text-white">{{$settings['site_name']}}</h2>
                    </a>
                </div>
                <div class="cs-main__header__right">
                    <div class="cs-nav">
                        <ul class="cs-nav__list">
                            <li class="menu-item-has-children"><a href="#">Категорії</a>
                                <ul>
                                    @foreach(categories() as $category)
                                        <li><a href="{{$category->link()}}">{{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach(menuPositionLinks('top') as $item)
                                <li><a href="{{$item['url']}}">{{$item['text']}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- .cs-nav -->
                </div><!-- .cs-main__header__right -->
            </div>
        </div>
    </div>
</header>
<!-- End Header Section -->

<!-- Page Head -->
<section class="cs-page__head cs-style1 cs-center text-center">
    <div class="container">
        <div class="cs-page__head__in">
            <h1 class="cs-page__head__title">{{$settings['site_slogan']}}</h1>
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="index.html">Home</a></li>--}}
{{--                <li class="breadcrumb-item active">Blog List</li>--}}
{{--            </ol>--}}
        </div>
    </div>
</section>
<!-- End Page Head -->
