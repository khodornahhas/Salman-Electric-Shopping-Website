<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'show'])->name('account');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.delete');
});

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist/count', [WishlistController::class, 'count']);
Route::post('/wishlist/toggle/{productId}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'total']);
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/confirm', [CartController::class, 'confirm']);
Route::post('/cart/place-order', [CartController::class, 'placeOrder']);


Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('product.details');

Route::get('/account', function () {
    return view('auth.account');
})->name('account');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orders', [OrderController::class, 'index'])->name('orders.index');
});



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');

Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');

Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');

// Optional: Other admin pages
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');

require __DIR__.'/auth.php';
