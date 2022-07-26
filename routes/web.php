<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;

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
//for viewing product and category
Route::get('/', [ProductController::class, 'trendingproduct']);

Route::get('category', [ProductController::class, 'trendcategory']);
Route::get('view-category/{slug}', [ProductController::class, 'view_cat']);
Route::get('view-category/{cate_slug}/{pro_slug}', [ProductController::class, 'prodetails']);
Auth::routes();


//for carts
Route::post('/addto_cart', [CartController::class, 'addcart']);
//add to wishlist
Route::post('addto_wish', [WishlistController::class, 'addwish']);
Route::post('delet_wish', [WishlistController::class, 'deletewish']);

Route::middleware(['auth'])->group(function () {

Route::post('delet_cart', [CartController::class, 'delete_cart']);
Route::get('cart', [CartController::class, 'viewcart']);
Route::post('update_cart', [CartController::class, 'updatecart']);
Route::get('checkout', [CheckoutController::class, 'index']);
Route::post('placeorder', [CheckoutController::class, 'placeorder']);

//to show order in users table

Route::get('my_orders', [UserController::class, 'index']);
Route::get('view_order/{id}', [UserController::class, 'view']);

//showing users in admin
Route::get('users', [UserController::class, 'allusers']);
Route::get('viewuser/{id}', [UserController::class, 'viewuser']);
//viewing a particular order
Route::get('adminview_order/{id}', [OrderController::class, 'vieworder']);
//for updating status
Route::put('update_status/{id}', [OrderController::class, 'statusupd']);
//showing orders in admin
Route::get('orders', [OrderController::class, 'userorders']);
//order history
Route::get('order_history', [OrderController::class, 'orderhis']);

//add to wish list
Route::get('wishlist', [WishlistController::class, 'index']);


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','isAdmin']], function () {

    Route::get('/dashboard', function () {
       return view('admin.index');
    });
    //for category
    Route::get('cat', [CategoryController::class, "index"]);
    Route::get('addcat', [CategoryController::class, "add"]);
    Route::post('insert_cat', [CategoryController::class, 'store']);
    Route::get('editcat/{id}', [CategoryController::class, 'editca']);
    Route::any('updatecat/{id}', [CategoryController::class, 'updaca'])->name('update');
    Route::get('deletecat/{id}', [CategoryController::class, 'deletcat']);

//for product
    Route::post('addprod', [ProductController::class, 'addprod']);
    Route::get('prods', [ProductController::class, 'index']);
    Route::get('add', [ProductController::class, 'add']);
    Route::get('editp/{id}', [ProductController::class, 'editpro']);
    Route::any('updpr/{id}', [ProductController::class, 'updatepro']);
    Route::get('delepro/{id}', [ProductController::class, 'deletepro']);
 });


