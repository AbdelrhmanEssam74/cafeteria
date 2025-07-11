<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/user/home', [AdminUserController::class, 'home'])->name('user.home');
});

// Google Auth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/products/{product}', [PageController::class, 'showProduct'])->name('products.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// User Order Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('user.orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('user.orders.show');
        Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('user.orders.cancel');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('user.orders.destroy');
        Route::delete('/', [OrderController::class, 'deleteAll'])->name('user.orders.delete-all');
    });
});

Route::post('/cart/store-order', [CartController::class, 'storeOrder'])->name('cart.storeOrder');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', AdminUserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::post('/{id}/status', [AdminOrderController::class, 'update'])->name('orders.status');
});