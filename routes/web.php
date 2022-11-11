<?php

use App\Http\Controllers\{Admin\DashboardController as AdminDashboardController,
    Admin\CategoryController as AdminCategoryController,
    Admin\ProductGalleryController,
    Admin\UserController,
    Auth\RegisterController,
    CartController,
    CategoryController,
    CheckoutController,
    Dashboard\AccountController,
    Dashboard\DashboardController,
    Dashboard\ProductController,
    Dashboard\StoreController,
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
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('dashboard.product');
    Route::get('/dashboard/product/{id}/detail', [ProductController::class, 'details'])->name('dashboard.product.details');
    Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create');
    Route::get('/dashboard/transaction', [TransactionController::class, 'index'])->name('dashboard.transaction');
    Route::get('/dashboard/transaction/{id}', [TransactionController::class, 'details'])->name('dashboard.transaction.details');
    Route::get('/dashboard/store', [StoreController::class, 'index'])->name('dashboard.store');
    Route::get('/dashboard/account', [AccountController::class, 'index'])->name('dashboard.account');
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
