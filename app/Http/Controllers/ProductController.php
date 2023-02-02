<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    function detail(Request $request ,$slug) 
    {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else { 
            $detail_product_by_id = Product::where("slug", "LIKE", "%{$slug}%")->get()[0];
            $get_laptop = Product::where("cat_id", 1)->get();
            $get_mobile = Product::where("cat_id", 2)->get();
            $get_smartwatch = Product::where("cat_id", 3)->get();
        }
        return view("product.detail", compact('detail_product_by_id', 'get_laptop', 'get_mobile', 'get_smartwatch'));
    }

    function list(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::orderBy("price", "asc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::orderBy("price", "desc")->paginate(20);
                } 
                return view("product.list", compact('products'));
            }

            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $products = Product::paginate(20);
            }
            $request->session()->forget(["name_empty", "qty_empty", "price_empty", "sub_total_empty", "total_price", "name_customer", "email_customer", "address_customer", "phone_customer", "code_order"]);
        return view("product.list", compact('products'));
        }
    }

    function laptop(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else { 
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->orderBy("price", "asc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->orderBy("price", "desc")->paginate(20);
                }
                return view("product.laptop", compact('get_laptop', 'products'));
            }

            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::paginate(20);
                    $get_laptop = Product::where("cat_id", 1)->where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $products = Product::paginate(20);
                $get_laptop = Product::where("cat_id", 1)->paginate(20);
            }
            return view("product.laptop", compact('get_laptop', 'products'));
        }
    }
    
    function mobile(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->orderBy("price", "asc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->orderBy("price", "desc")->paginate(20);
                }
                return view("product.mobile", compact('get_mobile', 'products'));
            }

            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::paginate(20);
                    $get_mobile = Product::where("cat_id", 2)->where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $products = Product::paginate(20);
                $get_mobile = Product::where("cat_id", 2)->paginate(20);
            }
            return view("product.mobile", compact('get_mobile', 'products'));
        }
    }

    function smartwatch(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->orderBy("price", "desc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->orderBy("price", "asc")->paginate(20);
                }
                return view("product.smartwatch", compact('get_smartwatch', 'products'));
            }
            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::paginate(20);
                    $get_smartwatch = Product::where("cat_id", 3)->where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $products = Product::paginate(20);
                $get_smartwatch = Product::where("cat_id", 3)->paginate(20);
            }
            return view("product.smartwatch", compact('get_smartwatch', 'products'));
        }
    }

    function iphone(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->orderBy("price", "asc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->orderBy("price", "desc")->paginate(20);
                }
                return view("product.iphone", compact('iphone', 'products'));
            }

            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::paginate(20);
                    $iphone = Product::where('trandmake', 'mobile_apple')->where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $iphone = Product::where('trandmake', 'mobile_apple')->paginate(20);
                $products = Product::paginate(20);
            }
            return view("product.iphone", compact('iphone', 'products'));
        }
    }

    function samsung(Request $request) {
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $get_smartwatch = Product::where("cat_id", 3)->get();
            $products = Product::where("name", "LIKE", "%{$keyword}%")->paginate(20);
            return view('home.keyword', compact('products', 'get_smartwatch'));
        } else {
            $filter_price = $request->input('filter_price');
            $filter_order = $request->input('order');
            if($filter_order) {
                if($filter_order == 'nothing') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->paginate(20);
                }
                if($filter_order == 'a_z') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->orderBy("name", "asc")->paginate(20);
                }
                if($filter_order == 'z_a') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->orderBy("name", "desc")->paginate(20);
                }
                if($filter_order == 'price_asc') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->orderBy("price", "asc")->paginate(20);
                }
                if($filter_order == 'price_desc') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->orderBy("price", "desc")->paginate(20);
                }
                return view("product.samsung", compact('samsung', 'products'));
            }

            if($filter_price) {
                if($filter_price == 'cheap') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->where("price","<" ,5000000)->paginate(20);
                } 
                if($filter_price == 'average') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->where("price",">=" ,5000000)->where("price","<=" ,10000000)->paginate(20);
                } 
                if($filter_price == 'expensive') {
                    $products = Product::paginate(20);
                    $samsung = Product::where('trandmake', 'mobile_samsung')->where("price",">" ,10000000)->paginate(20);
                } 
            } else {
                $samsung = Product::where('trandmake', 'mobile_samsung')->paginate(20);
                $products = Product::paginate(20);
            }
            return view("product.samsung", compact('samsung', 'products'));
        }
    }

}
