<!-- Footer Section -->
<footer class="cs-footer cs-style1 cs-color1">
    <div class="cs-height__110 cs-height__lg__70"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="cs-footer__item">
                    <h2 class="cs-widget__title">About</h2>
                    <div class="cs-footer__widget__text">We always try to give our best quality guidence for our all clients. So they will success & growth business well.</div>
                    <div class="cs-height__15 cs-height__lg__15"></div>
                    <div class="cs-social__btns cs-style1">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="cs-footer__item widget_nav_menu">
                    <h2 class="cs-widget__title">Категорії</h2>
                    <ul class="menu">
                        @foreach(categories() as $category)
                            <li>
                                <a href="{{$category->link()}}">
                                    {{$category->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="cs-footer__item widget_nav_menu">
                    <h2 class="cs-widget__title">Support</h2>
                    <ul class="menu">
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Reporting Issue</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="cs-footer__item widget_nav_menu">
                    <h2 class="cs-widget__title">Посилання</h2>
                    <ul class="menu">
                        @foreach(menuPositionLinks('social') as $link)
                            <li>
                                <a href="{{$link['url']}}" target="_blank">
                                    {{$link['text']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- .col -->
        </div>
        <!-- <div class="cs-height__85 cs-height__lg__40"></div> -->
    </div>
    <div class="cs-copyright text-center">
        <div class="container">© 2023 - {{date('Y')}} - {{$settings['site_name']}}. Усі права захищені.</div>
    </div>
    <div class="cs-parallax__shape cs-position1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13px" height="13px">
            <path fill-rule="evenodd" fill="rgb(97, 192, 49)" d="M6.500,-0.000 C10.090,-0.000 13.000,2.910 13.000,6.500 C13.000,10.090 10.090,13.000 6.500,13.000 C2.910,13.000 -0.000,10.090 -0.000,6.500 C-0.000,2.910 2.910,-0.000 6.500,-0.000 Z" />
        </svg>
    </div>
    <div class="cs-parallax__shape cs-position4">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="10px">
            <path fill-rule="evenodd" fill="rgb(62, 80, 110)" d="M5.000,-0.000 C7.761,-0.000 10.000,2.238 10.000,5.000 C10.000,7.761 7.761,10.000 5.000,10.000 C2.238,10.000 -0.000,7.761 -0.000,5.000 C-0.000,2.238 2.238,-0.000 5.000,-0.000 Z" />
        </svg>
    </div>
    <div class="cs-parallax__shape cs-position5">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
            <path fill-rule="evenodd" fill="rgb(112, 87, 248)" d="M7.500,-0.000 C11.642,-0.000 15.000,3.358 15.000,7.500 C15.000,11.642 11.642,15.000 7.500,15.000 C3.358,15.000 -0.000,11.642 -0.000,7.500 C-0.000,3.358 3.358,-0.000 7.500,-0.000 Z" />
        </svg>
    </div>
</footer>
<!-- Footer Section -->

<!-- Start Video Popup -->
<div class="cs-video__popup">
    <div class="cs-video__popup__overlay"></div>
    <div class="cs-video__popup__content">
        <div class="cs-video__popup__layer"></div>
        <div class="cs-video__popup__container">
            <div class="cs-video__popup__align">
                <div class="ratio ratio-16x9">
                    <iframe src="about:blank"></iframe>
                </div>
            </div>
            <div class="cs-video__popup__close"></div>
        </div>
    </div>
</div>
<!-- End Video Popup -->

<div id="cs-scrollup"><i class="fas fa-chevron-up"></i></div>
