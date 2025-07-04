<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/redirect', function () {
    $user = Auth::user();
    if ($user && $user->role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/user/home');
    }
});
Route::get('/', [UserController::class, 'home'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

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

// Checkout Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
});


// Order Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    // Add these two new routes for deletion
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::delete('/', [OrderController::class, 'deleteAll'])->name('orders.delete-all');
});

Route::post('/cart/order', [CartController::class, 'storeOrder'])->name('cart.order');