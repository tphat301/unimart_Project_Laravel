@extends("layouts.client")
@section("title", "Trang chủ")
@section("content")
<style type="text/css">
    a.cart_modal:hover {background: #2222df !important;}
    button.close_modal:hover {background: #818181 !important;}
    button.close:hover {color: #f00 !important;}
</style>  
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach ($sliders as $slider)
                        <div class="item">
                            <img src="{{asset($slider->slider)}}" alt="banner-1">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{asset('public/images/icon--96x104-2.png')}}">
                            </div>
                            <h3 class="title">Săn sale online</h3>
                            <p class="desc">Chỉ có tại ismart.com</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('public/images/Group-46580-100x100-1.png')}}">
                            </div>
                            <h3 class="title">Laptop tựu trường</h3>
                            <p class="desc">Liên hệ 1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('public/images/icond-100-100.png')}}">
                            </div>
                            <h3 class="title">Ưu đãi ngập trời</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('public/images/dong-ho-120x120.png')}}">
                            </div>
                            <h3 class="title">Bão sale đồng hồ</h3>
                            <p class="desc">Với nhiều hình thức sale</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{asset('public/images/icon-xa-hang-50-50x50-2.png')}}">
                            </div>
                            <h3 class="title">Xả hàng giảm sốc</h3>
                            <p class="desc">Với nhiều mặt hàng</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                {{-- Sản phẩm nổi bậc --}}
                <div class="section-detail">
                    <ul class="list-item">
                        {{-- Điện thoại --}}
                        @foreach ($get_mobile as $item)
                            <li>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb-carousel">
                                    <img src="{{asset($item->avatar)}}" class="img-item">
                                </a>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                    <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <button class="add-cart add-cart-feature-mobile fl-left" data-id="{{$item->id}}" data-toggle="modal" data-target="#ModalCenter" style="height: 30px; background: #fff; font-size: 12px;">
                                        Thêm giỏ hàng
                                    </button>
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                        {{-- Đồng hồ thông minh --}}
                        @foreach ($get_smartwatch as $item)
                            <li>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb-carousel">
                                    <img src="{{asset($item->avatar)}}" class="img-item">
                                </a>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                    <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <button class="add-cart add-cart-feature-mobile fl-left" data-id="{{$item->id}}" data-toggle="modal" data-target="#ModalCenter" style="background: #fff; font-size: 12px;">
                                        Thêm giỏ hàng
                                    </button>
                                    {{-- <a href="{{route('cart.add', $item->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a> --}}
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($get_mobile as $item)
                            <li>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                    <img src="{{asset($item->avatar)}}" class="img-item">
                                </a>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                    <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <button class="add-cart add-cart-feature-mobile fl-left" data-id="{{$item->id}}" data-toggle="modal" data-target="#ModalCenter" style="height: 30px; background: #fff; font-size: 12px;">
                                        Thêm giỏ hàng
                                    </button>
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($get_laptop as $item)
                            <li>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                    <img src="{{asset($item->avatar)}}" class="img-item">
                                </a>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                    <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <button class="add-cart add-cart-feature-mobile fl-left" data-id="{{$item->id}}" data-toggle="modal" data-target="#ModalCenter" style="height: 30px; background: #fff; font-size: 12px;">
                                        Thêm giỏ hàng
                                    </button>
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Đồng hồ thông minh</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($get_smartwatch as $item)
                            <li>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                    <img src="{{asset($item->avatar)}}" class="img-item">
                                </a>
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                    <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                </div>
                                <div class="action clearfix">
                                    <button class="add-cart add-cart-feature-mobile fl-left" data-id="{{$item->id}}" data-toggle="modal" data-target="#ModalCenter" style="height: 30px; background: #fff; font-size: 12px;">
                                        Thêm giỏ hàng
                                    </button>
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Modal product feature--}}   
            <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="position: relative;border-radius: 17px;background: #f7f7f7; transform: translateY(190px); max-width: 520px;">
                        <div class="modal-header" style="border: none;">
                        <span class="box-tick" style="display: flex;justify-content: center;margin: 18px;"><img class="img-tick" src="{{asset('public/images/tick.gif')}}" style="max-width: 150px !important;" alt=""></span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px;right: 10px;position: absolute;outline: none;
                        border: none;background: transparent; transition: all .25s linear">
                            <span aria-hidden="true" style="font-size: 26px;">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <p style="font-size: 20px; text-align: center; font-weight: bold;">Thông báo<br>
                                <span style="font-size: 14px; color:#7a7a7a;">Bạn muốn thêm sản phẩm vào giỏ hàng?</span></p>
                        </div>
                        <div class="modal-footer" style="border: none;">
                            <a class="cart_modal" style="background: #5a5aed;color: #fff;padding: 8px;border-radius: 4px;margin-right: 4px; transition: all .25s linear">Thêm giỏ hàng</a>
                            <button type="button" class="close_modal" data-dismiss="modal" style="background: #504e4e;color: #fff;padding: 4px 12px;border-radius: 4px;border: none; transition: all .25s linear">Ở lại trang này</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <li>
                            <a href="{{url('laptop.html')}}" title="Laptop">Laptop</a>
                        </li>
                        <li>
                            <a href="{{url('dien-thoai.html')}}" title="Điện thoại">Điện thoại</a>
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
                            <a href="{{url('dong-ho-thong-minh.html')}}" title="Đồng hồ thông minh">Đồng hồ thông minh</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($get_smartwatch as $item)
                            <li class="clearfix">
                                <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb fl-left">
                                    <img src="{{asset($item->avatar)}}" alt="{{$item->name}}">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="product-name">{{$item->name}}</a>
                                    <div class="price">
                                        <span class="new">{{number_format($item->price, 0, ",", ".")}}đ</span>
                                        <span class="old">{{number_format($item->price_old, 0, ",", ".")}}đ</span>
                                    </div>
                                    <a href="{{route('cart.buy_now', $item->slug)}}" title="Mua ngay" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
                <div class="section-detail">
                    <a href="#" title="" class="thumb">
                        <img src="public/images/sidebar-exten-1.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("button.add-cart-feature-mobile").click(function () { 
                let id = parseInt($(this).attr('data-id'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "{{url('ajax/cart/add')}}",
                    data: {id:id},
                    dataType: "JSON",
                    success: function (data) {
                        
                        let id = data.id;
                        let result = "https://thanhphat.unitopcv.com/project_unimart/cart/add/"+id;
                        $("a.cart_modal").attr("href", result);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            });
        });
    </script>
</div>
@endsection



