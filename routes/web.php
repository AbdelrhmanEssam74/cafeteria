<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminOrderController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('admin/orders', AdminOrderController::class);
Route::post('/{id}/status', [AdminOrderController::class, 'update'])->name('orders.status');



