<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class AdminCatProductController extends Controller
{
    function cat(Request $request) {
        $state = $request->input('state');
        $list_act = ["delete" => "Xóa tạm thời"];
        if($state == 'trash') {
            $list_act = [
                "restore" => "Khôi phục",
                "forceDelete" => "Xóa vĩnh viễn",
            ];
            $count_laptop = Product::where("cat_id", 1)->count();
            $count_mobile = Product::where("cat_id", 2)->count();
            $count_smartwatch = Product::where("cat_id", 3)->count();
            $count_cat_product = [$count_laptop, $count_mobile, $count_smartwatch];
            $cat_products = Product::onlyTrashed()->paginate(20);
        } else {
            $count_laptop = Product::where("cat_id", 1)->count();
            $count_mobile = Product::where("cat_id", 2)->count();
            $count_smartwatch = Product::where("cat_id", 3)->count();
            $count_cat_product = [$count_laptop, $count_mobile, $count_smartwatch];
            $cat_products = Product::paginate(20);
        }
        $count_active = Product::count();
        $count_trash = Product::onlyTrashed()->count();
        $count_state = [$count_active, $count_trash];
        return view("admin.products.cat", compact('cat_products', 'count_cat_product', 'count_state', 'list_act'));
    }

    function cat_product_delete($id) {
        $cat_product = Product::find($id);
        $cat_product -> delete();
        $cat_product->update(['state'=>'state2']);
        return redirect('admin/product/cat')->with("status", 'Xóa tạm thời danh mục thành công!');
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'restore') {
                    Product::withTrashed()->whereIn('id', $list_check)->restore();
                    Product::whereIn("id", $list_check)->update(['state'=>'state1']);
                    return redirect('admin/product/cat')->with("status", 'Khôi phục thành công danh mục!');
                }
                if($act == 'delete') {
                    Product::destroy($list_check);
                    Product::whereIn("id", $list_check)->update(['state'=>'state2']);
                    return redirect('admin/product/cat')->with("status", 'Xóa tạm thời danh mục thành công!');
                }
                if($act == '"forceDelete"') {
                    Product::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/product/cat')->with("status", 'Xóa vĩnh viễn danh mục thành công!');
                }
                return redirect('admin/product/cat')->with("error", 'Vui lòng chọn thao tác để thực hiện thao tác!');
            } 
        } else {
            return redirect('admin/product/cat')->with("error", 'Vui lòng tích chọn bản ghi để thực hiện thao tác!');
        }
    }

    function cat_product_update($id) {
        $product = Product::find($id);
        return view("admin.products.updateCat", compact('product'));
    }

    function cat_store(Request $request, $id) {
        Product::where('id', $id)->update(
            [
                "name" => $request->input('name'),
                "cat_product" => $request->input("cat_product"),
                "author" => $request->input("author"),
                "state" => $request->input("state"),
            ]
        );
        return redirect('admin/product/cat')->with('status', 'Cập nhật danh mục thành công!');
    }
}
