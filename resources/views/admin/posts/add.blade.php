@extends("layouts.admin")
@section("title", "Thêm bài viết")
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
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" id="name">
                </div>
                @error('title')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="author">Người đăng</label>
                    <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" name="slug" id="slug" value="{{request()->input('slug')}}">
                </div>
                @error('slug')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="desc">Mô tả bài viết</label>
                    <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"></textarea>
                </div>
                @error('desc')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                </div>
                @error('content')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="thumb" class="d-block">Ảnh bài viết</label>
                    <input type="file" name="thumb" id="thumb">
                </div>
                @error('thumb')
                    <small class="text-danger font-weight-bold">{{$message}}</small>
                @enderror
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="post_cat" class="form-control" id="">
                        <option value="nothing">Chọn danh mục</option>
                        <option value="news" selected>Tin tức công nghệ</option>
                        <option value="game">Giải trí</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="wait" value="wait">
                        <label class="form-check-label" for="wait">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                        <label class="form-check-label" for="active">
                            Đang hoạt động
                        </label>
                    </div>
                </div>
                <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection



