<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Slider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            $sliders = Slider::all();
            return view('home.keyword', compact('products', 'get_smartwatch', 'sliders'));
        } else {
            $get_laptop = Product::where("cat_id", 1)->get();
            $get_mobile = Product::where("cat_id", 2)->get();
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $sliders = Slider::all();
        }
        $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"]);
        return view('home.index', compact('get_laptop', 'get_mobile', 'get_smartwatch', 'sliders'));
    }
}
