<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/home', function () {
    $products = \App\Models\Product::all();

    return view('home', compact('products'));
})->name('home');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/{product}', [CartController::class, 'store'])
    ->name('cart.store');

Route::patch('/cart/{cart}/increase', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::patch('/cart/{cart}/decrease', [CartController::class, 'decrease'])
    ->name('cart.decrease');

Route::delete('/cart/{cart}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::resource('products', ProductController::class)
            ->except(['show']);

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');

    });