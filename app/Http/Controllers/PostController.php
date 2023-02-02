<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Post;
use App\Product;

class PostController extends Controller
{
    function list(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $posts = Post::paginate(20);
            $get_smartwatch = Product::where("cat_id", 3)->get();
        }
        return view("post.list", compact("posts", "get_smartwatch"));
    }

    function detail(Request $request, $slug) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } 
        $post_by_id = Post::where("slug", $slug)->get()[0];
        $get_smartwatch = Product::where("cat_id", 3)->get();
        $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"]);
        return view("post.detail", compact("post_by_id", "get_smartwatch"));
    }
}
