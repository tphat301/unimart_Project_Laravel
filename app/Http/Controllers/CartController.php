<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use App\Order;
use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    function show(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            return view("cart.show");
        }
    }

    function add($id) {
        $product_by_id = Product::find($id);
        Cart::add(
                    [
                        'id' => $id, 
                        'name' => $product_by_id->name, 
                        'qty' => 1, 
                        'price' => $product_by_id->price, 
                        'options' => ['avatar' => $product_by_id->avatar, 'code' => $product_by_id->code, 'slug' => $product_by_id->slug]
                    ]
        );
        return redirect('gio-hang.html');
    }

    function add_store(Request $request, $slug) {
        // return Cart::destroy();
        $product_by_id = Product::where("slug", "LIKE", "%{$slug}%")->get()[0];
        Cart::add(
            [
                'id' => $product_by_id->id, 
                'name' => $product_by_id->name, 
                'qty' => $request->get('num_order')[0], 
                'price' => $product_by_id->price, 
                'options' => ['avatar' => $product_by_id->avatar, 'code' => $product_by_id->code, 'slug' => $product_by_id->slug]
            ]
        );
        return redirect('gio-hang.html');
    }

    function ajax_cart_add() {
        $id = (int)$_POST['id'];
        $array_id = ['id'=>$id];
        echo json_encode($array_id);
    }

    function update(Request $request) {
        $carts = $request->get('qty');
        foreach($carts as $rowId => $qty) {
            Cart::update($rowId, $qty);
        }
        // return redirect('cart/show');
        return redirect('gio-hang.html');
    }
    
    function remove($rowId) {
        Cart::remove($rowId);
        // return redirect('cart/show');
        return redirect('gio-hang.html');
    }
    
    function destroy() {
        Cart::destroy();
        // return redirect('cart/show');
        return redirect('gio-hang.html');
    }
    
    function update_ajax(Request $request) {
        $id = $request->get('id');
        $qty = $request->get('qty');
        $sub_total = $request->get('sub_total') * $qty;
        Cart::update($request->get('rowID'), $qty);
        $result = [
            "sub_total" => number_format($sub_total, 0, ",", ".")."đ",
            "total" => number_format(Cart::total(), 0, ",", ".")."đ",
        ];
        echo json_encode($result);
    }

    function ajax_store() {
        $id = (int)$_GET['id'];
        $qty = (int)$_GET['qty'];
    }

    function buy_now($slug) {
        $product_by_id = Product::where("slug", "LIKE", "%{$slug}%")->get()[0];
        Cart::add(
                [
                    'id' => $product_by_id->id, 
                    'name' => $product_by_id->name, 
                    'qty' => 1, 
                    'price' => $product_by_id->price, 
                    'options' => ['avatar' => $product_by_id->avatar, 'code' => $product_by_id->code, 'slug' => $product_by_id->slug]
                ]
        );
        return redirect("thanh-toan.html");
    }

    function checkout() {
        return view("cart.checkout");
    }

    function buy_store(Request $request) { 
        $request->validate(
            [
                "fullname" => "required|string|min:8|max:255",
                "email" => "required|email|string|max:255",
                "address" => "required|string",
                "phone" => "required|max:10|regex:/^[0-9]+$/"
            ],
            [
                "required" => ":attribute không được bỏ trống!",
                "string" => ":attribute nhập vào phải ở dạng chuỗi ký tự!",
                "min" => ":attribute nhập vào phải có ít nhất :min ký tự!",
                "max" => ":attribute chỉ cho phép nhập tối đa :max ký tự!",
                "email" => ":attribute nhập vào chưa đúng định dạng của email!",
                "regex" => ":attribute chưa đúng định dạng!"

            ],
            [
                "fullname" => "Họ tên",
                "email" => "Email",
                "address" => "Địa chỉ",
                "phone" => "Số điện thoại",
            ]
        );
        $name_empty = [];
        $code_empty = [];
        $avatar_empty = [];
        $qty_empty = [];
        $total_qty = 0;
        $sub_total_empty = [];
        $price_empty = [];
        foreach (Cart::content() as $key => $row) {
            $name_empty[] = $row->name;
            $code_empty[] = $row->options->code;
            $avatar_empty[] = $row->options->avatar;
            $qty_empty[] = $row->qty;
            $price_empty[] = $row->price;
            $sub_total_empty[] = $row->total;
            $total_qty += $row->qty;
        }
        $name_product = implode(",", $name_empty);
        $code_product = implode(",", $code_empty);
        $thumb = implode(",", $avatar_empty);
        $qty = implode(",",  $qty_empty);
        $price = implode(",",  $price_empty);
        $total_price = Cart::total();
        $sub_total_price = implode(",", $sub_total_empty);
        $name_customer = $request->input('fullname');
        $email_customer = $request->input('email');
        $address_customer = $request->input('address');
        $phone_customer = $request->input('phone');
        $note_customer = $request->input('note');
        $payment = $request->input('payment');
        $code_r = Str::random(3);
        $string_random = Str::upper($code_r);
        $code_order = "UNI#".$string_random;
        Order::create(
            [
                'order_code' => $code_order,
                'fullname' => $name_customer,
                'email' => $email_customer,
                'address' => $address_customer,
                'phone' => $phone_customer,
                'note' => $note_customer,
                'name_product' => $name_product,
                'code_product' => $code_product,
                'thumb' => $thumb,
                'qty' => $qty,
                'price' => $price,
                'total_price' => $total_price,
                'total_qty' => $total_qty,
                'sub_total_price' => $sub_total_price,
                'payment' => $payment
            ]
        );
        $data = [
            "code_order" => $code_order,
            "fullname" => $name_customer,
            "address" => $address_customer,
            "email" => $email_customer,
            "phone" => $phone_customer,
            "name_product" => $name_empty,
            "price" => $price_empty,
            "qty" => $qty_empty,
            "sub_total" => $sub_total_empty,
            "total" => $total_price,
            "time_now" => Carbon::now()->format('d/m/Y m:h:s')
        ];
        Mail::to($email_customer)->send(new SendMail($data));
        session(
            [
                "name_empty" => $name_empty,
                "code_order" => $code_order,
                "qty_empty" => $qty_empty,
                "price_empty" => $price_empty,
                "sub_total_empty" => $sub_total_empty,
                "total_price" => $total_price,
                "name_customer" => $name_customer,
                "email_customer" => $email_customer,
                "address_customer" => $address_customer,
                "phone_customer" => $phone_customer 
            ]
        );
        Cart::destroy();
        return redirect("cart/order/show");
    }

    function order_show(Request $request) {  
        $name_empty = $request->session()->get("name_empty");
        $qty_empty = $request->session()->get("qty_empty");
        $code_order = $request->session()->get("code_order");
        $price_empty = $request->session()->get("price_empty");
        $sub_total_empty = $request->session()->get("sub_total_empty");
        $total_price = $request->session()->get("total_price");
        $name_customer = $request->session()->get("name_customer");
        $email_customer = $request->session()->get("email_customer");
        $address_customer = $request->session()->get("address_customer");
        $phone_customer = $request->session()->get("phone_customer");
        return view("cart.order", compact("name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"));
    }
}
