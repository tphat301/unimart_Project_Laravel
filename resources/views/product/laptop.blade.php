@extends("layouts.client")
@section("title", "Laptop")
@section("content")
<style type="text/css">
    a.cart_modal:hover {background: #2222df !important;}
    button.close_modal:hover {background: #818181 !important;}
    button.close:hover {color: #f00 !important;}
</style> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('laptop.html')}}" title="Laptop">Laptop</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Laptop</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị {{$get_laptop->total()}} trên {{$products->total()}} sản phẩm</p>
                        <div class="form-filter">
                            <form action="">
                                <select name="order">
                                    <option value="nothing">Sắp xếp</option>
                                    <option value="a_z">Từ A-Z</option>
                                    <option value="z_a">Từ Z-A</option>
                                    <option value="price_asc">Giá thấp lên cao</option>
                                    <option value="price_desc">Giá cao xuống thấp</option>
                                </select>
                                <button type="submit" name="btn-order">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @if ($get_laptop->total() > 0)
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
                        @else
                            <div style="align-items: center; text-align: -webkit-center; padding-top: 80px;">
                                <img src="{{asset('public/images/no-filter.png')}}" alt="" style="height: 8.5rem !important; width: auto;">
                                <span style="display: block; margin-top: 15px; font-size: 1.5rem">Rất tiếc! "ISMART" không tìm thấy sản phẩm nào cho mục này! Để tìm được kết quả chính xác hơn, bạn vui lòng: <strong style="color: #cd1818">Kiểm tra lại bộ lọc đã chọn và thực hiện lại! Xin cảm ơn.</strong></span>
                            </div>
                        @endif
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
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>{{$get_laptop->links()}}</li>
                    </ul>
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
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="filter_price" value="cheap"></td> 
                                    <td>Dưới 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="filter_price" value="average"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="filter_price" value="expensive"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" name="btn-filter" value="Lọc" style="background-color: #cd1818;outline: none; border: 1px solid #ccc; border-radius: 3px; display: block; margin: auto; width: 100px; height: 34px; color:#fff;">
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
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