<?php

namespace App\Http\Controllers;
use App\Page;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function about(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $page = Page::where("title","LIKE" ,"%Giới thiệu%")->get()[0];
            $get_smartwatch = Product::where("cat_id", 3)->get();
        }
        $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"]);
        return view("page.about", compact("page", "get_smartwatch"));
    }

    function contact(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $page = Page::where("title","LIKE" ,"%Liên hệ%")->get()[0];
            $get_smartwatch = Product::where("cat_id", 3)->get();
        }
        $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"]);
        return view("page.contact", compact("page", "get_smartwatch"));
    }
}
