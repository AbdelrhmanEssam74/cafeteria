<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminOrderController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
<<<<<<< HEAD

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes - Abdelrhman
Route::get('/admin', [AdminHomeController::class , 'dashboard'])->name('admin.dashboard');
// admin auth routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
=======
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('admin/orders', AdminOrderController::class);
Route::post('/{id}/status', [AdminOrderController::class, 'update'])->name('orders.status');



>>>>>>> manage_orders
