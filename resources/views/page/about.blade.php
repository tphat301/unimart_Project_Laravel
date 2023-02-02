@extends("layouts.client")
@section("title", "Giới thiệu")
@section("content")
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('gioi-thieu.html')}}" title="Giới thiệu">Giới thiệu</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" style="padding: 18px !important; box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$page->title}}</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">{{$page->created_at->format('d/m/Y m:h:s')}}</span>
                    <div class="detail">
                        <p>{!!$page->content!!}</p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
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
                    <a href="#" title="" class="thumb">
                        <img src="{{asset('public/images/sidebar-exten-1.png')}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection