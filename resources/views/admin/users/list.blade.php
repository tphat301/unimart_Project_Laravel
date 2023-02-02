@extends("layouts.admin")
@section("title", "Danh sách người dùng")
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
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form class="form-group">
                    <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm..." value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(["state"=>"active"])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(["state"=>"trash"])}}" class="text-danger">Vô hiệu hóa<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url("admin/user/action")}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" name="act" id="action">
                        <option>Chọn</option>
                        @foreach ($list_state as $key_state => $value)
                            <option value="{{$key_state}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary" onclick="return confirm('Bạn có muốn thực hiện thao tác này?');">
                </div>
                <table class="table table-hover table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">STT</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->total() > 0)
                        @php
                        $k=0;
                        @endphp
                        @foreach ($users as $user)
                        @php
                        $k++;
                        @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="{{$user->id}}">
                                </td>
                                <th scope="row">{{$k}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->role == "manager_all")
                                        <span class="text-info font-weight-bold">
                                            @php
                                                echo "Toàn quyền";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($user->role == "manager_post")
                                        <span class="text-primary font-weight-bold">
                                            @php
                                                echo "Quản lý bài viết";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($user->role == "manager_product")
                                        <span class="text-danger font-weight-bold">
                                            @php
                                                echo "Quản lý sản phẩm";
                                            @endphp
                                        </span>
                                    @endif
                                    @if ($user->role == "manager_page")
                                        <span class="text-warning font-weight-bold">
                                            @php
                                                echo "Quản lý trang";
                                            @endphp
                                        </span>
                                    @endif
                                </td>
                                <td>{{$user->created_at->format('m:h:s d/m/Y')}}</td>
                                <td>
                                    @if (Auth::id() == $user->id || Auth::user()->role == "manager_all")
                                        <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    @endif

                                    @if (Auth::id() != $user->id && Auth::user()->role == "manager_all")
                                        <a href="{{route("admin.user.delete", $user->id)}}" onclick="return confirm('Bạn có muốn xóa người dùng không?');" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td colspan="7"><p>Không tìm thấy bản ghi</p></td></tr>
                        @endif
                    </tbody>
                </table>
            </form>
            {{$users->links()}}
        </div>
    </div>
</div>  
@endsection