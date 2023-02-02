@extends("layouts.admin")
@section("title", "Thêm người dùng")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action="{{url('admin/user/store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                @error("name")
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                @error("email")
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                @error("password")
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select name="role" class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option value="manager_all">Toàn quyền</option>
                        <option value="manager_post">Quản lý bài viết</option>
                        <option value="manager_product">Quản lý sản phẩm</option>
                        <option value="manager_page">Quản lý trang</option>
                    </select>
                </div>
                <input type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">
            </form>
        </div>
    </div>
</div>
@endsection