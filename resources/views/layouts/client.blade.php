<!DOCTYPE html>
<html>
    <head>
        <title>@yield("title")</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{asset('public/images/logo-cps.png')}}" type="image/x-icon" />
        <link href="{{asset('public/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/reset.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/responsive.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{asset('public/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/main.js')}}" type="text/javascript"></script>
    </head>
    <body class="preloading">
        <div class="load">
            <img src="{{asset('public/images/loading.gif')}}" alt="loading">
        </div>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{url('/')}}" title="Ismart Store" id="payment-link" class="fl-left">Ismart Store</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="{{url('/')}}" title="Trang ch???">Trang ch???</a>
                                    </li>
                                    <li>
                                        <a href="{{url('san-pham.html')}}" title="S???n ph???m">S???n ph???m</a>
                                    </li>
                                    <li>
                                        <a href="{{url('bai-viet.html')}}" title="B??i vi???t">B??i vi???t</a>
                                    </li>
                                    <li>
                                        <a href="{{url('gioi-thieu.html')}}" title="Gi???i thi???u">Gi???i thi???u</a>
                                    </li>
                                    <li>
                                        <a href="{{url('lien-he.html')}}" title="Li??n h???">Li??n h???</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{asset('public/images/logo.png')}}"/></a>
                            <div id="search-wp" class="fl-left">
                                <form action="">
                                    <input type="text" name="keyword" id="s" placeholder="Nh???p t??? kh??a t??m ki???m t???i ????y!" value="{{request()->input('keyword')}}">
                                    <input type="submit" name="btn-search" id="sm-s" value="T??m ki???m">
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">T?? v???n</span>
                                    <span class="phone">0339.355.715</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="{{url('gio-hang.html')}}" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="num">{{Cart::count()}}</span>
                                    </div>
                                    <div id="dropdown">
                                        <p class="desc">C?? <span>{{Cart::count()}} s???n ph???m</span> trong gi??? h??ng</p>
                                        <ul class="list-cart">
                                            @foreach (Cart::content() as $row)
                                                <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="{{asset($row->options->avatar)}}" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name">{{$row->name}}</a>
                                                        <p class="price">{{number_format($row->total, 0, ",", ".")}}??</p>
                                                        <p class="qty">S??? l?????ng: <span class="qty_order">{{$row->qty}}</span></p>
                                                    </div>
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                        <div class="total-price clearfix">
                                            <p class="title fl-left">T???ng:</p>
                                            <p class="price fl-right">{{number_format(Cart::total(), 0, ",", ".")}}??</p>
                                        </div>
                                        <div class="action-cart clearfix">
                                            <a href="{{url('gio-hang.html')}}" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                            <a href="{{url('thanh-toan.html')}}" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End header --}}
                
                {{--Content --}}
                @yield("content")

                {{-- Begin Footer --}}
                <div id="footer-wp">
                    <div id="foot-body">
                        <div class="wp-inner clearfix">
                            <div class="block" id="info-company">
                                <h3 class="title">ISMART</h3>
                                <p class="desc">ISMART lu??n cung c???p lu??n l?? s???n ph???m ch??nh h??ng c?? th??ng tin r?? r??ng, ch??nh s??ch ??u ????i c???c l???n cho kh??ch h??ng c?? th??? th??nh vi??n.</p>
                                <div id="payment">
                                    <div class="thumb">
                                        <img src="{{asset('public/images/img-foot.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="block menu-ft" id="info-shop">
                                <h3 class="title">Th??ng tin c???a h??ng</h3>
                                <ul class="list-item">
                                    <li>
                                        <p>Th??nh ph??? H??? Ch?? Minh</p>
                                    </li>
                                    <li>
                                        <p>0339.355.715 - 0704.138.356</p>
                                    </li>
                                    <li>
                                        <p>abcd@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="block menu-ft policy" id="info-shop">
                                <h3 class="title">Ch??nh s??ch mua h??ng</h3>
                                <ul class="list-item">
                                    <li>
                                        <a href="#" title="">Quy ?????nh - ch??nh s??ch</a>
                                    </li>
                                    <li>
                                        <a href="#" title="">Ch??nh s??ch b???o h??nh - ?????i tr???</a>
                                    </li>
                                    <li>
                                        <a href="#" title="">Ch??nh s??ch h???i vi???n</a>
                                    </li>
                                    <li>
                                        <a href="#" title="">Giao h??ng - l???p ?????t</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="block" id="newfeed">
                                <h3 class="title">B???ng tin</h3>
                                <p class="desc">????ng k?? v???i chung t??i ????? nh???n ???????c th??ng tin ??u ????i s???m nh???t</p>
                            </div>
                        </div>
                    </div>
                    <div id="foot-bot">
                        <div class="wp-inner">
                            <p id="copyright">?? B???n quy???n thu???c v??? laravel_pro | Laravel</p>
                        </div>
                    </div>
                </div>
                </div>
                <div id="menu-respon">
                    <a href="{{url('/')}}" title="ISMART" class="logo">ISMART</a>
                    <div id="menu-respon-wp">
                        <ul class="" id="main-menu-respon">
                            <li>
                                <a href="{{url('laptop.html')}}" title="Laptop">Laptop</a>
                            </li>
                            <li>
                                <a href="{{url('dien-thoai.html')}}" title="??i???n tho???i">??i???n tho???i</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{url('dien-thoai/iphone.html')}}" title="Iphone">Iphone</a>
                                    </li>
                                    <li>
                                        <a href="{{url('dien-thoai/samsung.html')}}" title="Samsung">Samsung</a>  
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('dong-ho-thong-minh.html')}}" title="?????ng h??? th??ng minh">?????ng h??? th??ng minh</a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- <div id="btn-top"><img src="public/images/icon-to-top.png" alt=""/></div> --}}
                <div id="btn-top">
                    <div class="hotline-phone-ring-wrap">
                        <div class="hotline-phone-ring">
                        <div class="hotline-phone-ring-circle"></div>
                        <div class="hotline-phone-ring-circle-fill"></div>
                        <div class="hotline-phone-ring-img-circle">
                            <img src="{{asset('public/images/icon-to-top-new.png')}}" alt=""/>
                        </div>
                        </div>
                    </div>
                </div>
                    <style>
                    .hotline-phone-ring-wrap {
                    bottom: 0;
                    left: 0;
                    z-index: 999999;
                    }
                    .hotline-phone-ring {
                    position: relative;
                    visibility: visible;
                    background-color: transparent;
                    width: 110px;
                    height: 110px;
                    cursor: pointer;
                    z-index: 11;
                    -webkit-backface-visibility: hidden;
                    -webkit-transform: translateZ(0);
                    transition: visibility 0.5s;
                    left: 0;
                    bottom: 0;
                    display: block;
                    }
                    .hotline-phone-ring-circle {
                    width: 85px;
                    height: 85px;
                    top: 10px;
                    left: 10px;
                    position: absolute;
                    background-color: transparent;
                    border-radius: 100%;
                    border: 2px solid #e60808;
                    -webkit-animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
                    animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
                    transition: all 0.5s;
                    -webkit-transform-origin: 50% 50%;
                    -ms-transform-origin: 50% 50%;
                    transform-origin: 50% 50%;
                    opacity: 0.5;
                    }
                    .hotline-phone-ring-circle-fill {
                    width: 55px;
                    height: 55px;
                    top: 25px;
                    left: 25px;
                    position: absolute;
                    background-color: rgba(230, 8, 8, 0.7);
                    border-radius: 100%;
                    border: 2px solid transparent;
                    -webkit-animation: phonering-alo-circle-fill-anim 2.3s infinite
                        ease-in-out;
                    animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
                    transition: all 0.5s;
                    -webkit-transform-origin: 50% 50%;
                    -ms-transform-origin: 50% 50%;
                    transform-origin: 50% 50%;
                    }
                    .hotline-phone-ring-img-circle {
                    background-color: #e60808;
                    width: 33px;
                    height: 33px;
                    top: 37px;
                    left: 37px;
                    position: absolute;
                    background-size: 20px;
                    border-radius: 100%;
                    border: 2px solid transparent;
                    -webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
                    animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
                    -webkit-transform-origin: 50% 50%;
                    -ms-transform-origin: 50% 50%;
                    transform-origin: 50% 50%;
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    }
                    .hotline-phone-ring-img-circle .pps-btn-img {
                    display: -webkit-box;
                    display: -webkit-flex;
                    display: -ms-flexbox;
                    display: flex;
                    }
                    .hotline-phone-ring-img-circle .pps-btn-img img {
                    width: 20px;
                    height: 20px;
                    }
                    .hotline-bar {
                    position: absolute;
                    background: rgba(230, 8, 8, 0.75);
                    height: 40px;
                    width: 180px;
                    line-height: 40px;
                    border-radius: 3px;
                    padding: 0 10px;
                    background-size: 100%;
                    cursor: pointer;
                    transition: all 0.8s;
                    -webkit-transition: all 0.8s;
                    z-index: 9;
                    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                        0 10px 10px rgba(0, 0, 0, 0.1);
                    border-radius: 50px !important;
                    /* width: 175px !important; */
                    left: 33px;
                    bottom: 37px;
                    }
                    .hotline-bar > a {
                    color: #fff;
                    text-decoration: none;
                    font-size: 15px;
                    font-weight: bold;
                    text-indent: 50px;
                    display: block;
                    letter-spacing: 1px;
                    line-height: 40px;
                    font-family: Arial;
                    }
                    .hotline-bar > a:hover,
                    .hotline-bar > a:active {
                    color: #fff;
                    }
                        @-webkit-keyframes phonering-alo-circle-anim {
                            0% {
                            -webkit-transform: rotate(0) scale(0.5) skew(1deg);
                            -webkit-opacity: 0.1;
                            }
                            30% {
                            -webkit-transform: rotate(0) scale(0.7) skew(1deg);
                            -webkit-opacity: 0.5;
                            }
                            100% {
                            -webkit-transform: rotate(0) scale(1) skew(1deg);
                            -webkit-opacity: 0.1;
                            }
                        }
                        @-webkit-keyframes phonering-alo-circle-fill-anim {
                            0% {
                            -webkit-transform: rotate(0) scale(0.7) skew(1deg);
                            opacity: 0.6;
                            }
                            50% {
                            -webkit-transform: rotate(0) scale(1) skew(1deg);
                            opacity: 0.6;
                            }
                            100% {
                            -webkit-transform: rotate(0) scale(0.7) skew(1deg);
                            opacity: 0.6;
                            }
                        }
                        @-webkit-keyframes phonering-alo-circle-img-anim {
                            0% {
                            -webkit-transform: rotate(0) scale(1) skew(1deg);
                            }
                            10% {
                            -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
                            }
                            20% {
                            -webkit-transform: rotate(25deg) scale(1) skew(1deg);
                            }
                            30% {
                            -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
                            }
                            40% {
                            -webkit-transform: rotate(25deg) scale(1) skew(1deg);
                            }
                            50% {
                            -webkit-transform: rotate(0) scale(1) skew(1deg);
                            }
                            100% {
                            -webkit-transform: rotate(0) scale(1) skew(1deg);
                            }
                        }
                        @media (max-width: 768px) {
                            .hotline-bar {
                            display: none;
                            }
                        }
                    </style>
                <div id="fb-root"></div>
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <script type="text/javascript">
                $(document).ready(function () {
                    // LOAD IMG
                    $(window).on('load', function(event) {
                        $('body').removeClass('preloading');
                        // $('.load').delay(1000).fadeOut('fast');
                        $('.load').delay(500).fadeOut('fast');
                    });

                    })
                </script>
                </body>
                </html>