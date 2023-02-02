@extends("layouts.admin")
@section("title", "Cập nhật danh mục sản phẩm")
@section("content")
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật danh mục
                </div>
                <div class="card-body">
                    <form action="{{route('admin.product.cat_store', $product->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label for="cat_parent">Danh mục cha</label>
                            <input type="text" name="cat_product" class="form-control" id="cat_parent" value="@php
                                if($product->cat_product == "laptop") echo "Laptop";
                                if($product->cat_product == "mobile") echo "Điện thoại";
                                if($product->cat_product == "smartwatch") echo "Đồng hồ thông minh"; @endphp">
                        </div>
                        <div class="form-group">
                            <label for="author">Người tạo</label>
                            <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="state1" value="state1" checked>
                                <label class="form-check-label" for="state2">
                                    Đang hoạt động
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="state1" value="state2">
                                <label class="form-check-label" for="state2">
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







