@extends("layouts.client")
@section("title", "Bài viết")
@section("content")
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('bai-viet.html')}}" title="Danh sách bài viết">Danh sách bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" style="padding: 18px !important; box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($posts as $post)
                            <li class="clearfix">
                                <a href="{{route('post.detail', ['slug'=>$post->slug])}}" title="{{$post->title}}" class="thumb fl-left">
                                    <img src="{{asset($post->thumb)}}" alt="{{$post->title}}">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('post.detail',['slug'=>$post->slug])}}" title="{{$post->title}}" class="title">{{$post->title}}</a>
                                    <span class="create-date">{{$post->created_at}}</span>
                                    <p class="desc">{{$post->desc}}</p>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            {{-- pagging --}}
            {{$posts->links()}}
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