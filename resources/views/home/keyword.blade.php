@extends("layouts.client")
@section("title", "Kết quả tìm kiếm")
@section("content")
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{asset('public/images/banner-1.jpg')}}" alt="banner-1">
                    </div>
                    <div class="item">
                        <img src="{{asset('public/images/banner-2.png')}}" alt="banner-2">
                    </div>
                    <div class="item">
                        <img src="{{asset('public/images/banner-3.jpg')}}" alt="banner-3">
                    </div>
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
            
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Kết quả tìm kiếm</h3>
                </div>
                <div class="section-detail">
                    @if ($products->total() > 0)
                        <ul class="list-item clearfix">
                            @foreach ($products as $item)
                                <li>
                                    <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                        <img src="{{asset($item->avatar)}}">
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
                    @else
                        <div class="report_text" style="display: block;overflow: hidden;padding: 15px 20px;font-size: 18px;color: #f00;background: #fff;">
                            <h1>Rất tiếc, ISMART không tìm thấy kết quả nào phù hợp với từ khóa <strong style="color:black;">"{{request()->input('keyword')}}"</strong></h1>
                            <img src="{{asset('public/images/no-search.png')}}" alt="" style="height: 24rem; width: auto;">
                        </div>
                        <div class="noresultsuggestion" style="background: #fff;padding-left: 36%;padding-top: 3%;padding-bottom: 5%;margin-bottom: 2%;">
                            <h3>Để tìm được kết quả chính xác hơn, bạn vui lòng:</h3>
                            <ul>
                                <li>Kiểm tra lỗi chính tả của từ khóa đã nhập</li>
                                <li>Thử lại bằng từ khóa khác</li>
                                <li>Thử lại bằng những từ khóa tổng quát hơn</li>
                                <li>Thử lại bằng những từ khóa ngắn gọn hơn</li>
                            </ul>
                        </div>
                    @endif
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
                        <img src="{{asset('public/images/banner.png')}}" alt="">
                    </a>
                </div>
                <div class="section-detail">
                    <a href="#" title="" class="thumb">
                        <img src="{{asset('public/images/sidebar-exten-1.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection