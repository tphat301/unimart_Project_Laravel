@extends("layouts.admin")
@section("title", "Danh sách bài viết")
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
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['state'=>'active'])}}" class="text-primary">Đang hoạt động<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'trash'])}}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/post/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select name="act" class="form-control mr-1" id="">
                        <option>Chọn</option>
                        @foreach ($option as $k => $v)
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
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @if ($posts->total() > 0)
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($posts as $post)
                                @php
                                    $k++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                                    </td>
                                    <td scope="row">{{$k}}</td>
                                    <td><img src="{{asset($post->thumb)}}" alt="ảnh bài viết" style="width: 100px;height: 80px;" class="img-thumbnail"></td>
                                    <td><a href="{{route('post.detail', $post->slug)}}" class="font-weight-bold">{{$post->title}}</a></td>
                                    <td>
                                        @if ($post->post_cat == 'news')
                                            <a href="{{url('post/list')}}" class="font-weight-bold">
                                                @php
                                                    echo "Tin tức công nghệ";
                                                @endphp
                                            </a>
                                        @else
                                            <a href="{{url('post/list')}}" class="font-weight-bold">
                                                @php
                                                    echo "Giải trí";
                                                @endphp
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == "active")
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
                                    <td class="font-weight-bold">{{$post->created_at->format('m:h:s d/m/Y')}}</td>
                                    @if ($post->status == "active")
                                        <td>
                                            <a href="{{route('admin.post.update', $post->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.post.delete', $post->id)}}" class="btn btn-danger btn-sm rounded-0" onclick="return confirm('Bạn có muốn xóa bài viết?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @else
                                        <td colspan="2"></td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="7"><p>Không tìm thấy bản ghi</p></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{$posts->links()}}
        </div>
    </div>
</div>
@endsection