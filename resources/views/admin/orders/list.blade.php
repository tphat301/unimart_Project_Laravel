@extends("layouts.admin")
@section("title", "Danh sách đơn hàng")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['state'=>'all'])}}" class="text-info">Tất cả<span class="text-muted"> ({{$count_state[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_handle'])}}" class="text-warning">Đang xử lý<span class="text-muted"> ({{$count_state[1]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_transport'])}}" class="text-primary">Đang vận chuyển<span class="text-muted"> ({{$count_state[2]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'is_success'])}}" class="text-success">Thành công<span class="text-muted"> ({{$count_state[3]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'order_cancel'])}}" class="text-danger">Hủy đơn hàng<span class="text-muted"> ({{$count_state[4]}})</span></a>
            </div>
            <form action="{{url('admin/order/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="act" class="form-control mr-1" id="act">
                        <option value="">Chọn tác vụ</option>
                        @foreach ($list_act as $v => $act)
                            <option value="{{$v}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary" onclick="return confirm('Bạn có muốn thực hiện thao tác này?');">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Số diện thoại</th>
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
                            @foreach ($orders as $value)
                                @php
                                    $k++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$value->id}}">
                                    </td>
                                    <td>{{$k}}</td>
                                    <td><a href="{{route("admin.order.detail", $value->id)}}">{{$value->order_code}}</a></td>
                                    <td>{{$value->fullname}}</td>
                                    <td><span class="text-secondary">{{$value->phone}}</span></td>
                                    <td><span class="qty">{{$value->total_qty}}</span></td>
                                    <td><span class="text-danger font-weight-bold">{{number_format($value->total_price, 0, ",", ".")}}đ</span></td>
                                    <td>
                                        @if ($value->status_order == 'is_handle')
                                            <span class="badge badge-warning">
                                                @php
                                                    echo "Đang xử lý";
                                                @endphp
                                            </span>
                                        @endif
                                        @if ($value->status_order == 'is_transport')
                                            <span class="badge badge-primary">
                                                @php
                                                    echo "Đang vận chuyển";
                                                @endphp
                                            </span>
                                        @endif
                                        @if ($value->status_order == 'is_success')
                                            <span class="badge badge-success">
                                                @php
                                                    echo "Thành công";
                                                @endphp
                                            </span>
                                        @endif
                                        @if ($value->status_order == 'order_cancel')
                                            <span class="badge badge-danger">
                                                @php
                                                    echo "Hủy đơn hàng";
                                                @endphp
                                            </span>
                                        @endif
                                    </td>
                                    <td class="font-weight-bold">{{$value->created_at->format('d/m/Y m:h:s')}}</td>
                                    @if ($value->status_order != 'order_cancel')
                                        <td>
                                            <a href="{{route("admin.order.detail", $value->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật trạng thái đơn hàng"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.order.delete', $value->id)}}" onclick="return confirm('Bạn có muốn xóa đơn hàng?');" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Hủy đơn hàng"><i class="fa fa-trash"></i></a>
                                        </td> 
                                    @else
                                        <td colspan="2"></td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="12"><p>Không tìm thấy bản ghi</p></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{-- pagging --}}
            {{$orders->links()}}
        </div>
    </div>
</div>
@endsection