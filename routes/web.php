<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::middleware('guest')->group(function () {
    Route::post('/account', [AuthenticatedSessionController::class, 'store']);
});
Route::get('/account', [AccountController::class, 'show'])->name('account');

Route::middleware('auth')->group(function () {
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.delete');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/remove/{productId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist/count', [WishlistController::class, 'count']);
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/total', [CartController::class, 'total']);
Route::get('/cart/checkout', [CartController::class, 'checkout'])
    ->name('cart.checkout');

    Route::get('/cart/confirm', function () {
    return redirect('/cart')->with('error', 'Please complete the checkout form first.');
});
Route::post('/cart/confirm', [CartController::class, 'confirm']);

Route::post('/cart/place-order', [CartController::class, 'placeOrder']);


Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/shop/{categorySlug?}/brands/{brandSlugs?}/min-price/{minPrice?}/max-price/{maxPrice?}', [ShopController::class, 'index'])
    ->name('shop.filters')
    ->where([
        'categorySlug' => '[a-z0-9\-]*',  
        'brandSlugs'   => '[a-z0-9\-,]*', 
        'minPrice'     => '[0-9]+',
        'maxPrice'     => '[0-9]+',
    ]);

    
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('product.details');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/promocodes/redeem', [PromoCodeController::class, 'redeemForm'])->name('user.promocodes.redeem');
    Route::post('/promocodes/apply', [PromoCodeController::class, 'apply'])->name('user.promocodes.apply');
    Route::get('/check-promo', [PromoCodeController::class, 'checkActivePromo'])
    ->middleware('auth');
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('index');

        Route::get('/promocodes', [PromoCodeController::class, 'index'])->name('promocodes.index'); 
        Route::get('/promocodes/create', [PromoCodeController::class, 'create'])->name('promocodes.create'); 
        Route::post('/promocodes', [PromoCodeController::class, 'store'])->name('promocodes.store');
        Route::delete('/promocodes/{promocode}', [PromoCodeController::class, 'destroy'])->name('promocodes.destroy');


        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Admin Products
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminController::class, 'destroy'])->name('products.destroy');
        Route::get('/products/search', [AdminController::class, 'searchProducts'])->name('products.search');
        

        // Admin Stats
        Route::get('/stats', [AdminController::class, 'stats'])->name('stats');

        // Admin Users
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/users/search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search');
        Route::get('/users', [AdminController::class, 'users'])->name('users');

        // Admin Orders
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/search', [AdminController::class, 'searchOrders'])->name('orders.search');
        Route::delete('/orders/{order}', [AdminController::class, 'deleteOrder'])->name('orders.delete');

        // Admin Categories
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
        Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');

        // Admin Brands
        Route::get('/brands', [AdminController::class, 'brands'])->name('brands');
        Route::post('/brands', [AdminController::class, 'storeBrand'])->name('brands.store');
        Route::delete('/brands/{id}', [AdminController::class, 'deleteBrand'])->name('brands.delete');
        Route::put('/brands/{id}', [AdminController::class, 'updateBrand'])->name('brands.update');
    });

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::get('/order/success/{order}', [CartController::class, 'showSuccess']);


Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search.ajax');
Route::get('/search-all', [App\Http\Controllers\SearchController::class, 'searchAll'])->name('search.all');

require __DIR__.'/auth.php';
