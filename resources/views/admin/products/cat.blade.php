@extends("layouts.admin")
@section("title", "Danh mục sản phẩm")
@section("content")
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
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
                <div class="card-header font-weight-bold">
                    Danh sách danh mục
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="{{request()->fullUrlWithQuery(["state"=>"active"])}}" class="text-primary">Đang hoạt động<span class="text-muted">({{$count_state[0]}})</span></a>
                        <a href="{{request()->fullUrlWithQuery(["state"=>"trash"])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count_state[1]}})</span></a>
                    </div>
                    <form action="{{url("admin/cat_product/action")}}" method="POST">
                        @csrf
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" name="act" id="">
                                <option value="">Chọn thao tác</option>
                                @foreach ($list_act as $v => $a)
                                    <option value="{{$v}}">{{$a}}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-action" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Danh mục cha</th>
                                    <th scope="col">Danh mục con</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Thời gian tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cat_products->total() > 0)
                                    @php
                                    $k = 0;
                                    @endphp
                                    @foreach ($cat_products as $cat_product)
                                        @php
                                            $k++;
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="list_check[]" value="{{$cat_product->id}}">
                                            </td>
                                            <th scope="row">{{$k}}</th>
                                            <td>
                                                @if ($cat_product->cat_product == "laptop")
                                                        @php
                                                            echo "Laptop";
                                                        @endphp
                                                @endif   
                                                @if ($cat_product->cat_product == "mobile")
                                                        @php
                                                            echo "Điện thoại";
                                                        @endphp
                                                @endif   
                                                @if ($cat_product->cat_product == "smartwatch")
                                                        @php
                                                            echo "Đồng hồ thông minh";
                                                        @endphp
                                                @endif   
                                            </td>
                                            <td><a href="{{route('product.detail', $cat_product->slug)}}">{{$cat_product->name}}</a></td>
                                            <td>
                                                @if ($cat_product->state == "state1")
                                                    <span class="p-1 bg-primary text-white border-1 rounded">
                                                        @php
                                                            echo "Đang hoạt động";
                                                        @endphp
                                                    </span>
                                                @else
                                                    <span class="p-1 bg-warning text-white border-1 rounded">
                                                        @php
                                                            echo "Chờ duyệt";
                                                        @endphp
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{$cat_product->author}}</td>
                                            <td>{{$cat_product->created_at->format('d/m/Y m:h:s')}}</td>
                                            @if ($cat_product->state == "state1")
                                                <td>
                                                    <a href="{{route('admin.cat_product.update', $cat_product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('admin.cat_product.delete', $cat_product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn có muốn xóa danh mục sản phẩm?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            @else
                                                <td colspan="2"></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr><td colspan="9"><p>Không tìm thấy bản ghi</p></td></tr>
                                    @endif
                            </tbody>
                        </table>
                    </form>
                    {{$cat_products->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thống kê số lượng danh mục
                </div>
                <div class="card-body">
                    <table class="table table-hover table-checkall table-bordered bg-light">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Laptop</th>
                                <th scope="col">Điện thoại</th>
                                <th scope="col">Đồng hồ thông minh</th>
                            </tr>
                            <tr>
                                <th scope="col">Số lượng</th>
                                <td><span class="text-danger font-weight-bold">{{$count_cat_product[0]}}</span></td>
                                <td><span class="text-danger font-weight-bold">{{$count_cat_product[1]}}</span></td>
                                <td><span class="text-danger font-weight-bold">{{$count_cat_product[2]}}</span></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




