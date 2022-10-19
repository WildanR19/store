<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\AccountController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\HomeController;
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
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('/success', [HomeController::class, 'success'])->name('success');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/product', [ProductController::class, 'index'])->name('dashboard.product');
Route::get('/dashboard/product/{id}/detail', [ProductController::class, 'details'])->name('dashboard.product.details');
Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('dashboard.product.create');
Route::get('/dashboard/transaction', [TransactionController::class, 'index'])->name('dashboard.transaction');
Route::get('/dashboard/transaction/{id}', [TransactionController::class, 'details'])->name('dashboard.transaction.details');
Route::get('/dashboard/store', [StoreController::class, 'index'])->name('dashboard.store');
Route::get('/dashboard/account', [AccountController::class, 'index'])->name('dashboard.account');
