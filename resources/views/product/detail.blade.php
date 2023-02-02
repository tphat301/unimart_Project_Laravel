@extends("layouts.client")
@section("title", "Chi tiết sản phẩm")
@section("content")
<style type="text/css">
    a.cart_modal:hover {background: #2222df !important;}
    button.close_modal:hover {background: #818181 !important;}
    button.close:hover {color: #f00 !important;}
</style> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('product.detail', $detail_product_by_id->slug)}}" title="{{$detail_product_by_id->name}}">{{$detail_product_by_id->name}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" style='padding: 18px !important; box-shadow: 0 0 6px rgba(0, 0, 0, 0.3)'>
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="{{asset($detail_product_by_id->thumb_2)}}" data-zoom-image="{{asset($detail_product_by_id->thumb_2)}}"/>
                        </a>
                        <div id="list-thumb">
                            <a href="" data-image="{{asset($detail_product_by_id->thumb_2)}}" data-zoom-image="{{asset($detail_product_by_id->thumb_2)}}">
                                <img id="zoom" src="{{asset($detail_product_by_id->thumb_1)}}" />
                            </a>
                            <a href="" data-image="{{asset($detail_product_by_id->thumb_4)}}" data-zoom-image="{{asset($detail_product_by_id->thumb_4)}}">
                                <img id="zoom" src="{{asset($detail_product_by_id->thumb_3)}}" />
                            </a>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{asset($detail_product_by_id->avatar)}}" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$detail_product_by_id->name}}</h3>
                        <div class="desc">
                            <p>CPU: {{$detail_product_by_id->cpu}}</p>
                            <p>RAM: {{$detail_product_by_id->ram}}</p>
                            <p>Ổ cứng: {{$detail_product_by_id->rom}}</p>
                            <p>Màn hình: {{$detail_product_by_id->display}}</p>
                            <p>Hệ điều hành: {{$detail_product_by_id->opera}}</p>
                            <p>Trọng lượng: {{$detail_product_by_id->weight}}</p>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">
                                @if ($detail_product_by_id->state == "state1")
                                    @php
                                        echo "Còn hàng";
                                    @endphp
                                @else
                                    @php
                                        echo "Hết hàng";
                                    @endphp
                                @endif
                            </span>
                        </div>
                        <p class="price">{{number_format($detail_product_by_id->price, 0, ",", ".")}}đ</p>
                        @if ($detail_product_by_id->state == "state1")
                            <form action="{{route('cart.add.store', $detail_product_by_id->slug)}}" method="GET">
                                @csrf
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num_order[]" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <input type="submit" name="btn-add" title="Thêm giỏ hàng" class="add-cart" style="border:none;" value="Thêm giỏ hàng">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Thông tin sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p>{{$detail_product_by_id->desc}}</p>
                    <p>{!!$detail_product_by_id->content!!}</p>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm liên quan</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @if ($detail_product_by_id->cat_product == "mobile")
                            @foreach ($get_mobile as $item)
                                <li>
                                    <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                        <img src="{{asset($item->avatar)}}" alt="{{$item->name}}">
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
                                        <a href="{{route('cart.buy_now', $item->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                        @if ($detail_product_by_id->cat_product == "laptop")
                            @foreach ($get_laptop as $item)
                                <li>
                                    <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                        <img src="{{asset($item->avatar)}}" alt="{{$item->name}}">
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
                                        <a href="{{route('cart.buy_now', $item->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        @endif

                        @if ($detail_product_by_id->cat_product == "smartwatch")
                            @foreach ($get_smartwatch as $item)
                                <li>
                                    <a href="{{route('product.detail', $item->slug)}}" title="{{$item->name}}" class="thumb">
                                        <img src="{{asset($item->avatar)}}" alt="{{$item->name}}">
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
                                        <a href="{{route('cart.buy_now', $item->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
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
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{asset('public/images/banner.png')}}" alt="">
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