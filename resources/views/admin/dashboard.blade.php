@extends("layouts.admin")
@section("title", "Bảng điều khiển")
@section("content")
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count_order[0]}}</h5>
                    <p class="card-text">Đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐANG VẬN CHUYỂN</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count_order[1]}}</h5>
                    <p class="card-text">Đơn hàng đang vận chuyển</p>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count_order[2]}}</h5>
                    <p class="card-text">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count_order[3]}}</h5>
                    <p class="card-text">Đơn hàng bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($total_all_price, 0, ",", ".")}}đ</h5>
                    <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">NHẬP HÀNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$total_qty_product}}</h5>
                    <p class="card-text">Số lượng hàng</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">XUẤT KHO</div>
                <div class="card-body">
                    <h5 class="card-title">{{$total_qty_order}}</h5>
                    <p class="card-text">Số lượng sản phẩm</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">TỒN KHO</div>
                <div class="card-body">
                    <h5 class="card-title">{{$qty_warehouse}}</h5>
                    <p class="card-text">Số lượng còn lại</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá trị</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->total() > 0)
                        @php
                            $k = 0;
                        @endphp
                        @foreach ($orders as $order)
                            @php
                                $k++;
                            @endphp
                        <tr>
                            <th scope="row">{{$k}}</th>
                            <td><a href="{{route("admin.order.detail", $order->id)}}">{{$order->order_code}}</td>
                            <td>{{$order->fullname}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->total_qty}}</td>
                            <td><span class="text-danger font-weight-bold">{{number_format($order->total_price, 0, ",", ".")}}đ</span></td>
                            <td>
                                @if ($order->status_order == 'is_handle')
                                    <span class="badge badge-warning">
                                        @php
                                            echo "Đang xử lý";
                                        @endphp
                                    </span>
                                @endif
                                @if ($order->status_order == 'is_transport')
                                    <span class="badge badge-primary">
                                        @php
                                            echo "Đang vận chuyển";
                                        @endphp
                                    </span>
                                @endif
                                @if ($order->status_order == 'is_success')
                                    <span class="badge badge-success">
                                        @php
                                            echo "Thành công";
                                        @endphp
                                    </span>
                                @endif
                                @if ($order->status_order == 'order_cancel')
                                    <span class="badge badge-danger">
                                        @php
                                            echo "Hủy đơn hàng";
                                        @endphp
                                    </span>
                                @endif
                            </td>
                            <td>{{$order->created_at->format('d/m/Y m:h:s')}}</td>
                            <td>
                                <a href="{{route('dashboard.delete', $order->id)}}" onclick="return confirm('Bạn có muốn xóa đơn hàng?');" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="12"><p>Không tìm thấy bản ghi</p></td></tr>
                    @endif
                </tbody>
            </table>
            {{-- pagging laravel --}}
            {{$orders->links()}}
        </div>
    </div>
</div>
@endsection