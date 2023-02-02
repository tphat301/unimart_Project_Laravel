<?php
/* Phần Khai Báo */ 
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminCatPostController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminCatProductController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\PageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, "index"]);
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');   

//*PHẦN ĐỊNH TUYẾN ADMIN*//
Route::middleware("auth")->group(function() {
    Route::get("dashboard", [DashboardController::class, "show"]);
    Route::get("dashboard/delete/{id}", [DashboardController::class, "delete"])->name('dashboard.delete');
    Route::get("admin", [DashboardController::class, "show"]);
    // Định tuyến người dùng trong hệ thống
    Route::get("admin/user/list", [AdminUserController::class, "list"]);
    Route::get("admin/user/add", [AdminUserController::class, "add"])->middleware("CheckRole");
    Route::post("admin/user/store", [AdminUserController::class, "store"]);
    Route::get("admin/user/delete/{id}", [AdminUserController::class, "delete"])->name("admin.user.delete");
    Route::get("admin/user/edit/{id}", [AdminUserController::class, "edit"])->name("admin.user.edit");
    Route::post("admin/user/edit_store/{id}", [AdminUserController::class, "edit_store"])->name("admin.user.edit_store");
    Route::post("admin/user/action", [AdminUserController::class, "action"]);
    // Định tuyến sản phẩm
    Route::get("admin/product/add", [AdminProductController::class, "add"])->middleware('CheckRoleProduct');
    Route::get("admin/product/list", [AdminProductController::class, "list"])->middleware('CheckRoleProduct');
    Route::post("admin/product/store", [AdminProductController::class, "store"]);
    Route::get("admin/product/delete/{id}", [AdminProductController::class, "delete"])->name('admin.product.delete');
    Route::post("admin/product/action", [AdminProductController::class, "action"])->name('admin.product.action');
    Route::get("admin/product/edit/{id}", [AdminProductController::class, "edit"])->name("admin.product.edit");
    Route::post("admin/product/edit_store/{id}", [AdminProductController::class, "edit_store"])->name("admin.product.edit_store");
    // Định tuyến danh mục sản phẩm
    Route::get("admin/product/cat", [AdminCatProductController::class, "cat"])->middleware('CheckRoleProduct');
    Route::post("admin/cat_product/action", [AdminCatProductController::class, "action"]);
    Route::post("admin/product/cat_store/{id}", [AdminCatProductController::class, "cat_store"])->name('admin.product.cat_store');
    Route::get("admin/cat_product/delete/{id}", [AdminCatProductController::class, "cat_product_delete"])->name('admin.cat_product.delete');
    Route::get("admin/cat_product/update/{id}", [AdminCatProductController::class, "cat_product_update"])->name('admin.cat_product.update');
    // Định tuyến bài viết
    Route::get("admin/post/add", [AdminPostController::class, "add"])->middleware("CheckRolePost");
    Route::post("admin/post/store", [AdminPostController::class, "store"]);
    Route::get("admin/post/list", [AdminPostController::class, "list"])->middleware("CheckRolePost");
    Route::get("admin/post/update/{id}", [AdminPostController::class, "update"])->name("admin.post.update");
    Route::post("admin/post/update_store/{id}", [AdminPostController::class, "update_store"])->name("admin.post.update_store");
    Route::post("admin/post/action", [AdminPostController::class, "action"]);
    Route::get("admin/post/delete/{id}", [AdminPostController::class, "delete"])->name('admin.post.delete');
    // Định tuyến danh mục bài viết
    Route::get('admin/post/cat', [AdminCatPostController::class, "cat"])->middleware("CheckRolePost");
    Route::get('admin/cat_post/delete/{id}', [AdminCatPostController::class, "delete"])->name('admin.cat_post.delete');
    Route::post('admin/cat_post/action', [AdminCatPostController::class, "action"]);
    Route::get('admin/cat_post/update/{id}', [AdminCatPostController::class, "cat_post_update"])->name('admin.cat_post.update');
    Route::post("admin/post/cat_store/{id}", [AdminCatPostController::class, "cat_store"])->name('admin.post.cat_store');
    // Định tuyến đơn hàng
    Route::get("admin/order/list", [AdminOrderController::class, "list"]);
    Route::post("admin/order/action", [AdminOrderController::class, "action"]);
    Route::get("admin/order/detail/{id}", [AdminOrderController::class, "detail"])->name('admin.order.detail');
    Route::get("admin/order/delete/{id}", [AdminOrderController::class, "delete"])->name('admin.order.delete');
    // Định tuyến trang Page
    Route::get('admin/page/list', [AdminPageController::class, "list"])->middleware("CheckRolePage");
    Route::get('admin/page/delete/{id}', [AdminPageController::class, "delete"])->name('admin.page.delete');
    Route::get('admin/page/add', [AdminPageController::class, "add"])->middleware("CheckRolePage");
    Route::get('admin/page/update/{id}', [AdminPageController::class, "update"])->name('admin.page.update');
    Route::post('admin/page/update_store/{id}', [AdminPageController::class, "update_store"])->name('admin.page.update_store');
    Route::post('admin/page/action', [AdminPageController::class, "action"]);
    Route::post('admin/page/store', [AdminPageController::class, "store"]);
    // Định tuyến Slider
    Route::get("admin/slider/list", [AdminSliderController::class, "list"]);
    Route::post("admin/slider/store", [AdminSliderController::class, "store"]);
    Route::get("admin/slider/delete/{id}", [AdminSliderController::class, "delete"])->name('admin.slider.delete');
    Route::get("admin/slider/convert_status/{id}", [AdminSliderController::class, "convert_status"])->name('admin.slider.convert_status');

    // File manager laravel
    Route::group(['prefix' => 'laravel-filemanager'], function () {\UniSharp\LaravelFilemanager\Lfm::routes();});
});



//* PHẦN ĐỊNH TUYẾN PHÍA NGƯỜI DÙNG *//

// Định tuyến sản phẩm
Route::get("san-pham/{slug}", [ProductController::class, "detail"])->name("product.detail");
Route::get("san-pham.html", [ProductController::class, "list"])->name('product.list');
Route::get("laptop.html", [ProductController::class, "laptop"]);
Route::get("dien-thoai.html", [ProductController::class, "mobile"]);
Route::get("dong-ho-thong-minh.html", [ProductController::class, "smartwatch"]);
Route::get("dien-thoai/iphone.html", [ProductController::class, "iphone"]);
Route::get("dien-thoai/samsung.html", [ProductController::class, "samsung"]);

// Định tuyến bài viết
Route::get("bai-viet.html", [PostController::class, "list"]);
Route::get("bai-viet/{slug}", [PostController::class, "detail"])->name('post.detail');

// Định tuyến giỏ hàng
Route::get('gio-hang.html', [CartController::class, "show"]);
Route::get('cart/add/{id}', [CartController::class, "add"])->name('cart.add');
Route::get('cart/add/store/{slug}', [CartController::class, "add_store"])->name('cart.add.store');
Route::post('cart/update', [CartController::class, "update"]);
Route::get('cart/update_ajax', [CartController::class, "update_ajax"]);
Route::get('cart/ajax_store', [CartController::class, "ajax_store"]);
Route::get('cart/remove/{rowId}', [CartController::class, "remove"])->name('cart.remove');
Route::get('cart/destroy', [CartController::class, "destroy"]);
Route::get('cart/buy_now/{slug}', [CartController::class, "buy_now"])->name('cart.buy_now');
Route::get('thanh-toan.html', [CartController::class, "checkout"]);
Route::post('cart/checkout/store', [CartController::class, "buy_store"]);
Route::post('ajax/cart/add', [CartController::class, "ajax_cart_add"]);
Route::get('cart/order/show', [CartController::class, "order_show"]);

// Định tuyến trang page
Route::get("gioi-thieu.html", [PageController::class, "about"]);
Route::get("lien-he.html", [PageController::class, "contact"]);


