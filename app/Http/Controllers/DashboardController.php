<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(["module_active"=>"dashboard"]);
            return $next($request);
        });
    }

    function show() 
    {
        // $check_role = Auth::user()->role;
        // return $check_role;
        $count_is_handle = Order::where("status_order", "LIKE", "%is_handle%")->count();
        $count_is_transport = Order::where("status_order", "LIKE", "%is_transport%")->count();
        $count_is_success = Order::where("status_order", "LIKE", "%is_success%")->count();
        $count_order_cancel = Order::onlyTrashed()->count();
        $count_order = [$count_is_handle, $count_is_transport, $count_is_success, $count_order_cancel];
        $orders = Order::paginate(25);
        $array_total_price_empty = [];
        $array_total_price = Order::select("total_price")->get();

        foreach($array_total_price as $item) {
            $array_total_price_empty[] = $item->total_price;
        } 
        $qty_product_empty = [];
        $qty_product = Product::select("qty")->get();

        foreach($qty_product as $item) {
            $qty_product_empty[] = $item->qty;
        }

        $qty_order_empty = [];
        $qty_order = Order::select("total_qty")->get();

        foreach($qty_order as $item) {
            $qty_order_empty[] = $item->total_qty;
        }
        $total_qty_order = array_sum($qty_order_empty);
        $total_qty_product = array_sum($qty_product_empty);
        $total_all_price = array_sum($array_total_price_empty);
        $qty_warehouse = $total_qty_product - $total_qty_order;
        return view("admin.dashboard", compact("orders", "count_order", "total_all_price", "qty_warehouse", "total_qty_order", "total_qty_product"));
    }

    function delete($id) {
        $order = Order::find($id);
        $order->delete();
        DB::table('orders')->where('id', $id)->update(['status_order'=> 'order_cancel']);
        return redirect('dashboard')->with('status', 'Xóa đơn hàng thành công!');
    }
}
