@extends("layouts.admin")
@section("title", "Chỉnh sửa sản phẩm")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('admin.product.edit_store', $product_by_id->id)}}" method='POST'>
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="form-group col-6 pr-0">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{$product_by_id->name}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="author">Người tạo</label>
                                <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6 pr-0">
                                <label for="price">Cập nhật giá</label>
                                <input class="form-control" type="text" name="price" id="price" value="{{$product_by_id->price}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="qty">Số lượng</label>
                                <input class="form-control" type="number" name="qty" id="qty" value="{{$product_by_id->qty}}" min="0" max="100">
                            </div>
                        </div>
                        @error("price")
                            <small class="text-danger font-weight-bold">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control" id="intro" cols="30" rows="5">{{$product_by_id->desc}}</textarea>
                        </div>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{$product_by_id->content}}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="state1" value="state1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Còn hàng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="state2" value="state2">
                        <label class="form-check-label" for="exampleRadios2">
                            Hết hàng
                        </label>
                    </div>
                </div>
                <input type="submit" name="btn-update" class="btn btn-primary" value="Cập nhật">
            </form>
        </div>
    </div>
</div>
@endsection