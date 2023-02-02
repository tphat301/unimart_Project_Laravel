@extends("layouts.admin")
@section("title", "Danh sách trang")
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
            <h5 class="m-0 ">Danh sách trang</h5>
            <div class="form-search form-inline">
                <form action="#" class="form-group">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['state'=>'acitve'])}}" class="text-primary">Đang hoạt động<span class="text-muted">({{$count_state[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['state'=>'trash'])}}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count_state[1]}})</span></a>
            </div>
            <form action="{{url('admin/page/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="">
                        <option>Chọn tác vụ</option>
                        <option value="restore">Khôi phục</option>
                        <option value="delete">Xóa tạm thời</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Tên trang</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pages->total() > 0)
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($pages as $page)
                            @php
                                $k++;
                            @endphp
                                <tr>
                                    <td><input type="checkbox" name="list_check[]" value="{{$page->id}}"></td>
                                    <td scope="row">{{$k}}</td>
                                    <td><a href="">{{$page->title}}</a></td>
                                    <td>
                                        @if ($page->status == "active")
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
                                    <td>{{$page->author}}</td>
                                    <td>{{$page->created_at->format('m:h:s d/m/Y')}}</td>
                                    @if ($page->status == "active")
                                        <td>
                                            <a href="{{route('admin.page.update', $page->id)}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.page.delete', $page->id)}}" class="btn btn-danger btn-sm rounded-0" onclick="return confirm('Bạn có muốn xóa trang?');" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
            {{-- pagging --}}
            {{$pages->links()}}
        </div>
    </div>
</div>
@endsection