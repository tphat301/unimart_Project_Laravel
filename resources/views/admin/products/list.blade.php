@extends("layouts.admin")
@section("title", "Danh sách sản phẩm")
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
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            {{-- Search Products --}}
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['prod_state'=>'active'])}}" class="text-primary">Đang hoạt động<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['prod_state'=>'trash'])}}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/product/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3 ">
                    <select name="act" class="form-control mr-1" id="act">
                        <option>Chọn</option>
                        @foreach ($act as $k => $v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-act" value="Áp dụng" class="btn btn-primary" onclick="return confirm('Bạn có muốn thực hiện thao tác này?');">
                </div>
                <table class="table table-checkall table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->total() > 0)
                            
                            @php
                                $k=0;
                            @endphp
                            
                            @foreach ($products as $product)
                                @php
                                    $k++;
                                @endphp
                                <tr class="">
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$product->id}}">
                                    </td>
                                    <td>{{$k}}</td>
                                    <td><img class="img-thumbnail" src="{{asset($product->thumb_3)}}" alt="" style="max-width:98px;"></td>
                                    <td class="font-weight-bold"><a href="{{route('product.detail', $product->slug)}}">{{$product->name}}</a></td>
                                    <td>
                                        @if ($product->cat_product == "laptop")
                                            <a href="{{url('product/laptop')}}" class="font-weight-bold">
                                                @php
                                                    echo "Laptop";
                                                @endphp
                                            </a>
                                        @endif
                                        @if ($product->cat_product == "mobile")
                                            <a href="{{url('product/mobile')}}" class="font-weight-bold">
                                                @php
                                                    echo "Điện thoại";
                                                @endphp
                                            </a>
                                        @endif
                                        @if ($product->cat_product == "smartwatch")
                                            <a href="{{url('product/smartwatch')}}" class="font-weight-bold">
                                                @php
                                                    echo "Đồng hồ thông minh";
                                                @endphp
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-danger font-weight-bold">{{number_format($product->price, 0, ",", ".")}}đ</td>
                                    <td><span class="author">{{$product->author}}</span></td>
                                    <td class="font-weight-bold">{{$product->created_at->format('m:h:s d/m/Y')}}</td>
                                    <td>
                                        @if ($product->state == "state1")
                                            <span class="badge badge-success">
                                                @php
                                                    echo "Còn hàng ($product->qty)";
                                                @endphp
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                @php
                                                    echo "Hết hàng";
                                                @endphp
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                                        <a href="{{route("admin.product.delete", $product->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn có muốn xóa sản phẩm?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="9"><p>Không tìm thấy bản ghi</p></td></tr>
                        @endif
                        
                    </tbody>
                </table>
            </form>
            {{-- Pagination is handling --}}
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection