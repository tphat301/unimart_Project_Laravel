@extends("layouts.admin")
@section("title", "Cập nhật bài viết")
@section("content")
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật bài viết
                </div>
                <div class="card-body">
                    <form action="{{route('admin.post.update_store', $post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên bài viết</label>
                            <input class="form-control" type="text" name="title" id="name" value="{{$post->title}}">
                        </div>
                        @error('title')
                            <small class="text-danger font-weight-bold">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="author">Người tạo</label>
                            <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                        </div>
                        @error('author')
                            <small class="text-danger font-weight-bold">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="desc">Mô tả bài viết</label>
                            <textarea name="desc" class="form-control" id="desc" cols="30" rows="5">{{$post->desc}}</textarea>
                        </div>
                        @error('desc')
                            <small class="text-danger font-weight-bold">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="content">Nội dung bài viết</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="5">{!!$post->content!!}</textarea>
                        </div>
                        @error('content')
                            <small class="text-danger font-weight-bold">{{$message}}</small>
                        @enderror
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                                <label class="form-check-label" for="active">
                                    Đang hoạt động
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="wait" value="wait">
                                <label class="form-check-label" for="wait">
                                    Chờ duyệt
                                </label>
                            </div>
                        </div>
                        <input type="submit" name="btn_update" class="btn btn-primary" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection