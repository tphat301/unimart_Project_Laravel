@extends("layouts.admin")
@section("title", "Thêm sản phẩm")
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
        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="col-12 d-flex justify-content-between p-0">
                            <div class="form-group mr-2">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" name="price" id="price">
                            </div>     
                            <div class="form-group mr-2">
                                <label for="price-old">Giá cũ</label>
                                <input class="form-control" type="text" name="price_old" id="price-old">
                            </div>    
                            
                            <div class="form-group">
                                <label for="code">Mã</label>
                                <input class="form-control" type="text" name="code" id="code">
                            </div>
                            
                            <div class="form-group col-3 pr-0">
                                <label for="cat-id">Chỉ số danh mục</label>
                                <input class="form-control" type="number" name="cat_id" id="cat-id" min="1">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="desc">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"></textarea>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex justify-content-between p-0">
                        <div class="form-group col-3">
                            <label for="cpu">CPU</label>
                            <input class="form-control" type="text" name="cpu" id="cpu">
                        </div>
        
                        <div class="form-group col-3">
                            <label for="ram">RAM</label>
                            <input class="form-control" type="text" name="ram" id="ram">
                        </div>
                        
                        <div class="form-group col-3">
                            <label for="rom">ROM</label>
                            <input class="form-control" type="text" name="rom" id="rom">
                        </div>
                        
                        <div class="form-group col-3">
                            <label for="weight">Trọng lượng</label>
                            <input class="form-control" type="text" name="weight" id="weight">
                        </div>
                        
                    </div>

                    <div class="col-6  d-flex justify-content-between p-0">
                        <div class="form-group col-6">
                            <label for="display">Màn hình</label>
                            <input class="form-control" type="text" name="display" id="display">
                        </div>
                        
                        <div class="form-group col-6">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug">
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex justify-content-between p-0">
                        <div class="form-group col-6">
                            <label for="thumb-1">Ảnh chi tiết 1</label>
                            <input  type="file" name="thumb_1" id="thumb-1">
                        </div>
                        <div class="form-group col-6">
                            <label for="thumb-2">Ảnh chi tiết 2</label>
                            <input  type="file" name="thumb_2" id="thumb-2">
                        </div>
                        <div class="form-group col-6">
                            <label for="thumb-3">Ảnh chi tiết 3</label>
                            <input  type="file" name="thumb_3" id="thumb-3">
                        </div>
                        <div class="form-group col-6">
                            <label for="thumb-4">Ảnh chi tiết 4</label>
                            <input  type="file" name="thumb_4" id="thumb-4">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex p-0">
                        <div class="form-group col-6">
                            <label for="author">Người tạo</label>
                            <input class="form-control" type="text" name="author" id="author" value="{{Auth::user()->name}}" min="0" max="100" disabled>
                        </div>
                        <div class="form-group col-6">
                            <label for="qty">Số lượng</label>
                            <input class="form-control" type="number" name="qty" id="qty" value="1" min="0" max="100">
                        </div>
                    </div>

                    <div class="col-6  d-flex justify-content-between p-0">
                        <div class="form-group col-6">
                            <label for="opera">Hệ điều hành</label>
                            <input class="form-control" type="text" name="opera" id="opera">
                        </div>
                        
                        <div class="form-group col-6">
                            <label for="trandmake">Thương hiệu</label>
                            <input class="form-control" type="text" name="trandmake" id="trandmake">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="content">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                </div>
            
                <div class="form-group">
                    <label for="avatar" class="d-block">Ảnh đại diện sản phẩm</label>
                    <input type="file" name="avatar">
                </div>
                
                <div class="form-group">
                    <label for="cat-product">Danh mục</label>
                    <select name="cat_product" class="form-control" id="cat-product">
                        <option>Chọn danh mục</option>
                        <option value="laptop">Laptop</option>
                        <option value="mobile">Điện thoại</option>
                        <option value="smartwatch">Đồng hồ thông minh</option>
                    </select>
                    
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
                <input type="submit" name="btn-add" class="btn btn-primary" value="Thêm sản phẩm">
            </form>
        </div>
    </div>
</div>
@endsection