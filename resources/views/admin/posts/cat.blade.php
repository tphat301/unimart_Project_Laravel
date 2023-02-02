@extends("layouts.admin")
@section("title", "Danh sách danh mục")
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
                        <a href="{{request()->fullUrlWithQuery(["state"=>"trash"])}}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count_state[1]}})</span></a>
                    </div>
                    <form action="{{url("admin/cat_post/action")}}" method="POST">
                        @csrf
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" name="act" id="">
                                <option value="">Chọn thao tác</option>
                                    @foreach ($list_state as $v_att => $v)
                                        <option value="{{$v_att}}">{{$v}}</option>
                                    @endforeach
                            </select>
                            <input type="submit" name="btn-action" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <table class="table table-hover table-checkall">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Danh mục cha</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Thời gian tạo</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cat_posts->total() > 0)
                                    @php
                                    $k = 0;
                                    @endphp
                                    @foreach ($cat_posts as $cat_post)
                                        @php
                                            $k++;
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="list_check[]" value="{{$cat_post->id}}">
                                            </td>
                                            <th scope="row">{{$k}}</th>
                                            <td>
                                                @if ($cat_post->post_cat == "news")
                                                        @php
                                                            echo "Tin tức công nghệ";
                                                        @endphp
                                                @endif   
                                                @if ($cat_post->post_cat == "game")
                                                        @php
                                                            echo "Giải trí";
                                                        @endphp
                                                @endif    
                                            </td>
                                            <td><a href="{{route('post.detail', $cat_post->slug)}}">{{$cat_post->title}}</a></td>
                                            <td>
                                                @if ($cat_post->status == "active")
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
                                            <td>{{$cat_post->author}}</td>
                                            <td>{{$cat_post->created_at->format('d/m/Y m:h:s')}}</td>
                                            @if ($cat_post->status == "active")
                                                <td>
                                                    <a href="{{route('admin.cat_post.update', $cat_post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('admin.cat_post.delete', $cat_post->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn có muốn xóa danh mục sản phẩm?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
                    {{$cat_posts->links()}}
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
                                <th scope="col">Tin tức</th>
                                <th scope="col">Giải trí</th>
                            </tr>
                            <tr>
                                <th scope="col">Số lượng</th>
                                <td><span class="text-danger font-weight-bold">{{$count_cat[0]}}</span></td>
                                <td><span class="text-danger font-weight-bold">{{$count_cat[1]}}</span></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection