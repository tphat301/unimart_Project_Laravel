@extends("layouts.client")
@section("title", "Giỏ hàng")
@section("content")
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('gio-hang.html')}}" title="Giỏ hàng">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form action="{{url('cart/update')}}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Cart::count() > 0)
                                @foreach (Cart::content() as $row)
                                    <tr>
                                        <td>{{$row->options->code}}</td>
                                        <td>
                                            <a href="{{route('product.detail', $row->options->slug)}}" title="{{$row->name}}" class="thumb">
                                                <img src="{{asset($row->options->avatar)}}" alt="{{$row->name}}">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('product.detail', $row->options->slug)}}" title="{{$row->name}}" class="name-product">{{$row->name}}</a>
                                        </td>
                                        <td>{{number_format($row->price, 0, ",", ".")}}đ</td>
                                        <td>
                                            <input type="number" sub_total="{{$row->price}}" rowID="{{$row->rowId}}" data="{{$row->id}}" name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="num-order" min="1">
                                        </td>
                                       
                                        <td><span class="sub_total-{{$row->id}}">{{number_format($row->total, 0, ",", ".")}}đ</span></td>
                                        <td>
                                            <a href="{{route('cart.remove', $row->rowId)}}" title="Xóa" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr><td colspan="7"><img src="{{asset('public/images/no-search.png')}}" alt="" style="height: 24rem; width: auto;"><div style="text-align:left; padding-left:10px; color:#f00; font-weight:bold; font-size: 24px;text-align: center;">ISMART không tìm thấy sản phẩm trong giỏ hàng!</div></td></tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span>{{number_format(Cart::total(), 0, ",", ".")}}đ</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input type="submit" name="btn-update" style="text-align:center;" title="Cập nhật giỏ hàng" id="update-cart" value="Cập nhật giỏ hàng">
                                            <a href="{{url('thanh-toan.html')}}" title="Thanh toán" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="{{url('/')}}" title="Mua tiếp" id="buy-more">Mua tiếp</a><br/>
                <a href="{{url('cart/destroy')}}" title="Xóa giỏ hàng" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Ajax cart handle 
    $(document).ready(function() {
        $("input[class='num-order']").change(function() {
            let sub_total = $(this).attr('sub_total');
            let id = $(this).attr('data');
            let qty = $(this).val();
            let rowID = $(this).attr("rowID");
            data = {id:id, qty:qty, sub_total:sub_total, rowID:rowID};
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            $.ajax({
                url: "{{url('cart/update_ajax')}}",
                data: data,
                dataType: "JSON",
                method: "GET",
                success: function(data) {
                    $(".sub_total-"+id).text(data["sub_total"]);
                    $("#total-price span").text(data["total"]);
                    return false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });
</script>
@endsection


