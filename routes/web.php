<?php

use App\Http\Controllers\{Admin\DashboardController as AdminDashboardController,
    Admin\CategoryController as AdminCategoryController,
    Admin\ProductGalleryController,
    Admin\UserController,
    Auth\RegisterController,
    CartController,
    CategoryController,
    CheckoutController,
    Dashboard\DashboardController,
    Dashboard\ProductController,
    Dashboard\SettingController,
    Dashboard\TransactionController,
    HomeController};
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories.detail');
Route::get('/details/{slug}', [HomeController::class, 'details'])->name('details');
Route::get('/success', [HomeController::class, 'success'])->name('success');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::middleware('auth')->group(function () {
    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('/add-to-cart/{id}', [HomeController::class, 'addToCart'])->name('addToCart');

    //checkout
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // dashboard product
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('dashboard.product');
    Route::get('/dashboard/product/{id}/detail', [ProductController::class, 'details'])->name('dashboard.product.details');
    Route::post('/dashboard/product/{id}', [ProductController::class, 'update'])->name('dashboard.product.update');
    Route::post('/dashboard/product-gallery/', [ProductController::class, 'uploadGallery'])->name('dashboard.product.gallery.upload');
    Route::get('/dashboard/product-gallery/{id}', [ProductController::class, 'deleteGallery'])->name('dashboard.product.gallery.delete');
    Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create');
    Route::post('/dashboard/product', [ProductController::class, 'store'])->name('dashboard.product.store');

    // dashboard transaction
    Route::get('/dashboard/transaction', [TransactionController::class, 'index'])->name('dashboard.transaction');
    Route::get('/dashboard/transaction/{id}', [TransactionController::class, 'details'])->name('dashboard.transaction.details');
    Route::post('/dashboard/transaction/{id}', [TransactionController::class, 'update'])->name('dashboard.transaction.update');

    // dashboard setting
    Route::get('/dashboard/store', [SettingController::class, 'storeIndex'])->name('dashboard.store');
    Route::get('/dashboard/account', [SettingController::class, 'accountIndex'])->name('dashboard.account');
    Route::post('/dashboard/setting', [SettingController::class, 'update'])->name('dashboard.setting.update');
});

Route::prefix('admin')
    ->middleware('admin')
    ->group(function() {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
    });
