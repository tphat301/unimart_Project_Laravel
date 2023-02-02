<?php
namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(
                [
                    "module_active" => "order"
                ]
            );
            return $next($request);
        });
    }

    function list(Request $request) {
        $keyword = "";
        $state = $request->input('state');
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(25);
        }
        $list_act = [
            "is_handle" => "Đang xử lý",
            "is_transport" => "Đang vận chuyển",
            "is_success" => "Thành công",
            "restore" => "Khôi phục",
            "order_cancel" => "Hủy đơn hàng",
        ];
        if($state) {
            $list_act = [
                "is_handle" => "Đang xử lý",
                "is_transport" => "Đang vận chuyển",
                "is_success" => "Thành công",
                "restore" => "Khôi phục",
                "order_cancel" => "Hủy đơn hàng",
            ];
            if($state == 'all') {
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(25);
            }
            if($state == 'is_handle') {
                $list_act = [
                    "is_transport" => "Đang vận chuyển",
                    "is_success" => "Thành công",
                    "restore" => "Khôi phục",
                    "order_cancel" => "Hủy đơn hàng",
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_handle")->paginate(25);
            }
            if($state == 'is_transport') {
                $list_act = [
                    "is_handle" => "Đang xử lý",
                    "is_success" => "Thành công",
                    "restore" => "Khôi phục",
                    "order_cancel" => "Hủy đơn hàng",
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_transport")->paginate(25);
            }
            if($state == 'is_success') {
                $list_act = [
                    "is_handle" => "Đang xử lý",
                    "is_transport" => "Đang vận chuyển",
                    "restore" => "Khôi phục",
                    "order_cancel" => "Hủy đơn hàng",
                ];
                $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->where("status_order", "is_success")->paginate(25);
            }
            if($state == 'order_cancel') {
                $list_act = [
                    "is_handle" => "Đang xử lý",
                    "is_transport" => "Đang vận chuyển",
                    "is_success" => "Thành công",
                    "restore" => "Khôi phục",
                    "forget_delete" => "Xóa vĩnh viễn"
                ];
                $orders = Order::onlyTrashed()->where("fullname", "LIKE", "%{$keyword}%")->paginate(25);
            }
            $count_all = Order::count();
            $count_handle = Order::where("status_order", "is_handle")->count();
            $count_transport = Order::where("status_order", "is_transport")->count();
            $count_success = Order::where("status_order", "is_success")->count();
            $count_forget_delete = Order::onlyTrashed()->count();
            $count_state = [$count_all, $count_handle, $count_transport, $count_success, $count_forget_delete];
            return view("admin.orders.list", compact('orders', 'count_state', 'list_act'));
        }
        $count_all = Order::count();
        $count_handle = Order::where("status_order", "is_handle")->count();
        $count_transport = Order::where("status_order", "is_transport")->count();
        $count_success = Order::where("status_order", "is_success")->count();
        $count_forget_delete = Order::onlyTrashed()->count();
        $count_state = [$count_all, $count_handle, $count_transport, $count_success, $count_forget_delete];
        $orders = Order::where("fullname", "LIKE", "%{$keyword}%")->paginate(25);
        return view("admin.orders.list", compact('orders', 'count_state', 'list_act'));
    }

    function detail($id) {
        $order_by_id = Order::withTrashed()->find($id);
        $thumb_by_id = Order::withTrashed()->select('thumb')->find($id);
        $price_by_id = Order::withTrashed()->select('price')->find($id);
        $sub_total_by_id = Order::withTrashed()->select('sub_total_price')->find($id);
        $name_product_by_id = Order::withTrashed()->select('name_product')->find($id);
        $qty_by_id = Order::withTrashed()->select('qty')->find($id);
        $sub_total_arr =  explode(",", $sub_total_by_id->sub_total_price);
        $price_arr =  explode(",", $price_by_id->price);
        $qty_arr =  explode(",", $qty_by_id->qty);
        $thumb_arr =  explode(",", $thumb_by_id->thumb);
        $name_product =  explode(",", $name_product_by_id->name_product);
        return view("admin.orders.detail",compact("order_by_id", "thumb_arr", "name_product", "qty_arr", "price_arr", "sub_total_arr"));
    }

    function delete($id) {
        $order = Order::find($id);
        $order->delete();
        $order->update(['status_order'=> 'order_cancel']);
        return redirect('admin/order/list')->with('status', 'Hủy đơn hàng thành công!');
    }

    function action(Request $request) {
        $list_check = $request->input('list_check');
        if($list_check) {
            if(!empty($list_check)) {
                $act = $request->input('act');
                if($act == 'is_handle') {
                    Order::whereIn('id', $list_check)->update(['status_order'=> 'is_handle']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái đơn hàng đang xử lý thành công!');
                }
                if($act == 'is_transport') {
                    Order::whereIn("id", $list_check)->update(['status_order'=> 'is_transport']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái đơn hàng đang vận chuyển thành công!');
                }
                if($act == 'is_success') {
                    Order::whereIn("id", $list_check)->update(['status_order'=> 'is_success']);
                    return redirect('admin/order/list')->with('status', 'Cập nhật trạng thái xử lý đơn hàng thành công!');
                }
                if($act == 'restore') {
                    Order::withTrashed()->whereIn("id", $list_check)->restore();
                    Order::whereIn('id', $list_check)->update(['status_order'=> 'is_handle']);
                    return redirect('admin/order/list')->with('status', 'Khôi phục đơn hàng thành công!');
                }
                if($act == 'order_cancel') {
                    Order::destroy($list_check);
                    Order::onlyTrashed()->update(['status_order'=> 'order_cancel']);
                    return redirect('admin/order/list')->with('status', 'Hủy đơn hàng thành công!');
                }
                if($act == 'forget_delete') { 
                    Order::withTrashed()->whereIn("id", $list_check)->forceDelete();
                    return redirect('admin/order/list')->with('status', 'Xóa vĩnh viễn đơn hàng thành công!');
                }
                return redirect('admin/order/list')->with('error', 'Vui lòng chọn thao tác để thao tác!');
            }
        } else {
            return redirect('admin/order/list')->with('error', 'Vui lòng chọn bản ghi để thao tác!');
        }
    }
}
