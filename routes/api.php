<?php

use App\Http\Controllers\API\Admin\CategoryController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/register/check', [RegisterController::class, 'check'])->name('api-register-check');
Route::get('/location/province', [LocationController::class, 'province'])->name('api.location.province');
Route::get('/location/regency/{province_id}', [LocationController::class, 'regency'])->name('api.location.regency');

Route::get('/home', [HomeController::class, 'index'])->name('api.home');

Route::resource('/admin/category', CategoryController::class);
