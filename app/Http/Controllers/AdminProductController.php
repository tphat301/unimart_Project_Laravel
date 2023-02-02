<?php
namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\User;
class AdminProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session([
                "module_active" => "product"
            ]);
            return $next($request);
        });
    }

    function add() 
    {
        return view("admin.products.add");
    }

    function store(Request $request) {
        $request->validate(
            [
                "name" => "required|string",
                "content" => "required",
                "price" => "required|regex:/^[0-9]+$/",
                "price_old" => "required|regex:/^[0-9]+$/",
                "code" => "unique:products|required",
                "cat_id" => "required|regex:/^[0-9]+$/",
                "desc" => "required|string",
                "cpu" => "required",
                "ram" => "required",
                "rom" => "required",
                "weight" => "required",
                "display" => "required",
                "slug" => "required|regex:/^[A-Za-z0-9_-]+$/",
                "opera" => "string|required",
                "trandmake" => "string|required",
                "avatar" => "required|unique:products",
                "thumb_1" => "required|unique:products",
                "thumb_2" => "required|unique:products",
                "thumb_3" => "required|unique:products",
                "thumb_4" => "required|unique:products",
            ],
            [
                "required" => ":attribute không được để trống",
                "regex" => ":attribute chưa đúng định dạng",
                "unique" => ":attribute đã tồn tại trên hệ thống",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "name" => "Tên sản phẩm",
                "price" => "Giá của sản phẩm",
                "price_old" => "Giá cũ của sản phẩm",
                "code" => "Mã sản phẩm",
                "cat_id" => "Chỉ số danh mục sản phẩm",
                "desc" => "Mô tả sản phẩm",
                "content" => "Chi tiết sản phẩm",
                "cpu" => "CPU",
                "ram" => "RAM", 
                "rom" => "ROM",
                "weight" => "Trọng lượng sản phẩm",
                "display" => "Màn hình",
                "slug" => "Link thân thiện sản phẩm",
                "opera" => "Hệ điều hành sản phẩm",
                "trandmake" => "Thương hiệu của sản phẩm",
                "avatar" => "Ảnh đại diện của sản phẩm",
                "thumb_1" => "Ảnh slide 1 của sản phẩm",
                "thumb_2" => "Ảnh slide 2 của sản phẩm",
                "thumb_3" => "Ảnh slide 3 của sản phẩm",
                "thumb_4" => "Ảnh slide 4 của sản phẩm",
            ]
        );

        if($request->hasFile('avatar')) {
            $file = $request->avatar;
            $file_name = $file->getClientOriginalName();
            $file->move("public/uploads/", $file_name);
            $upload_avatar = "public/uploads/".$file_name;
        } 
        
        if($request->hasFile('thumb_1')) {
            $file1 = $request->thumb_1;
            $file_name1 = $file1->getClientOriginalName();
            $file1->move("public/uploads", $file_name1);
            $upload_file1 = "public/uploads/".$file_name1;
        } 
        if($request->hasFile('thumb_2')) {
            $file2 = $request->thumb_2;
            $file_name2 = $file2->getClientOriginalName();
            $file2->move("public/uploads", $file_name2);
            $upload_file2 = "public/uploads/".$file_name2;
        } 
        if($request->hasFile('thumb_3')) {
            $file3 = $request->thumb_3;
            $file_name3 = $file3->getClientOriginalName();
            $file3->move("public/uploads", $file_name3);
            $upload_file3 = "public/uploads/".$file_name3;
        } 
        if($request->hasFile('thumb_4')) {
            $file4 = $request->thumb_4;
            $file_name4 = $file4->getClientOriginalName();
            $file4->move("public/uploads", $file_name4);
            $upload_file4 = "public/uploads/".$file_name4;
        } 

        Product::create(
            [
                "name" => $request->input("name"),
                "price" => $request->input("price"),
                "price_old" => $request->input("price_old"),
                "code" => $request->input("code"),
                "cat_id" => $request->input("cat_id"),
                "desc" => $request->input("desc"),
                "content" => $request->input("content"),
                "cpu" => $request->input("cpu"),
                "ram" => $request->input("ram"), 
                "rom" => $request->input("rom"),
                "weight" => $request->input("weight"),
                "display" => $request->input("display"),
                "slug" => $request->input("slug"),
                "qty" =>  $request->input("qty"),
                "author" =>  $request->input("author"),
                "state" => $request->input("state"),
                "cat_product" => $request->input("cat_product"),
                "opera" => $request->input("opera"),
                "trandmake" => $request->input("trandmake"),
                "avatar" =>  $upload_avatar,
                "thumb_1" =>  $upload_file1,
                "thumb_2" =>  $upload_file2,
                "thumb_3" =>  $upload_file3,
                "thumb_4" =>  $upload_file4,
            ]
        );
        
        return redirect("admin/product/add")->with("status", "Thêm sản phẩm thành công!");
    }
    
    function list(Request $request) 
    {
        
        $key_word = "";
        $prod_state = $request->input("prod_state");
        $act = ["delete" => "Xóa tạm thời"];
        if($prod_state == "trash") {
            $act = [
                "restore" => "Khôi phục",
                "forceDelete" => "Xóa vĩnh viễn"
            ];
            $products = Product::onlyTrashed()->paginate(20);
        } else {
            if($request->input("keyword")) {
                $key_word = $request->input("keyword");
            }
            $cat_product = [
                "laptop" => "Laptop",
                "mobile" => "Điện thoại",
                "smartwatch" => "Đồng hồ thông minh"
            ];
            $products = Product::where("name", "LIKE", "%{$key_word}%")->paginate(20);
        } 
        $count_prod_active = Product::count();
        $count_prod_trash = Product::onlyTrashed()->count();
        $count = [$count_prod_active, $count_prod_trash];
        return view("admin.products.list", compact("products", "count", "act"));
    }

    function delete($id) {
        Product::find($id)->delete();
        return redirect("admin/product/list")->with("status", "Bạn đã xóa sản phẩm thành công!");
    } 

    function action(Request $request)
    {
        $list_check = $request->input("list_check");
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input("act");
                if($act == "delete") {
                    Product::destroy($list_check);
                    return redirect("admin/product/list")->with("status", "Bạn đã xóa sản phẩm thành công!");
                }
                if($act == "restore") {
                    Product::withTrashed()->whereIn("id", $list_check)->restore();
                    return redirect("admin/product/list")->with("status", "Bạn đã khôi phục sản phẩm thành công!");
                }
                if($act == "forceDelete") {
                    Product::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect("admin/product/list")->with("status", "Bạn đã xóa vĩnh viễn sản phẩm thành công!");
                }
                return redirect("admin/product/list")->with("error", "Bạn cần chọn thao tác để áp dụng thao tác!");
            } 
        } else {
            return redirect("admin/product/list")->with("error", "Thao tác không thành công!");
        }
    }

    function edit($id) {
        // $user = Product::find($id)->user;
        $product_by_id = Product::find($id);
        return view("admin.products.edit", compact('product_by_id'));
    }

    function edit_store(Request $request, $id) {
        $request->validate(
            [
                "name" => "required|string",
                "price" => "required|regex:/^[0-9]+$/",
            ],
            [
                "required" => ":attribute không được để trống",
                "regex" => ":attribute chưa đúng định dạng",
                "string" => ":attribute phải ở dạng chuỗi",
            ],
            [
                "name" => "Tên sản phẩm",
                "price" => "Giá của sản phẩm",
            ]
        );
        Product::find($id)->update(
            [
                "name" => $request->input("name"),
                "price" => $request->input("price"),
                "desc" => $request->input("desc"),
                "content" => $request->input("content"),
                "qty" => $request->input("qty"),
                "author" => $request->input("author"),
                "state" => $request->input("state")
            ]
        );
        return redirect('admin/product/list')->with("status", "Cập nhật sản phẩm thành công");
    }
}
