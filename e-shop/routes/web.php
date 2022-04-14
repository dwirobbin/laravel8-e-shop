<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'indexHome']);
Route::get('all-categories', [FrontendController::class, 'indexCategories'])
    ->name('all-categories');
Route::get('view-product/category/{slug}', [
    FrontendController::class, 'indexProductByCategory'
])->name('view-product-by-category');
Route::get('view-product/category/{category_slug}/{product_slug}/detail', [
    FrontendController::class, 'indexProductDetailByCategory'
]);

Route::post('add-to-cart', [CartController::class, 'addProduct']);
Route::post('delete-cart-item', [CartController::class, 'deleteProduct']);
Route::post('update-cart', [CartController::class, 'updateCart']);
Route::get('load-cart-data', [CartController::class, 'cartCount']);

Route::post('add-to-wishlist', [WishlistController::class, 'addWishlist']);
Route::post('delete-wishlist-item', [WishlistController::class, 'deleteItem']);
Route::get('load-wishlist-data', [WishlistController::class, 'wishlistCount']);

Route::middleware(['auth'])->group(function () {
    Route::get('view-cart', [CartController::class, 'indexCart'])
        ->name('view.cart');
    Route::get('view-cart/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');
    Route::post('place-order', [CheckoutController::class, 'placeOrder'])
        ->name('place.order');
    Route::get('my-orders', [UserController::class, 'index'])->name('my.orders');
    Route::get('view-order/{id}', [UserController::class, 'viewOrder'])->name('view.order');
    Route::get('dashboard/users', [UserController::class, 'viewAllUsers'])->name('users.index');
    Route::get('dashboard/users/{name}', [UserController::class, 'viewDetailUsers'])->name('users.show');

    Route::get('dashboard/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('dashboard/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('dashboard/orders/{order}/update', [OrderController::class, 'update'])->name('orders.update');
    Route::get('dashboard/orders-history', [OrderController::class, 'orderHistory'])->name('orders.history');
    Route::get('view-wishlist', [WishlistController::class, 'indexWishlist'])->name('view.wishlist');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register');

Route::get('dashboard/index', fn () => view('backend.dashboard.index'))
    ->name('dashboard.index');

Route::resource('dashboard/categories', CategoryController::class)->except(['show']);

Route::resource('dashboard/products', ProductController::class)->except(['show']);
