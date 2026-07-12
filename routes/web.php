<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return auth()->check() && auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.products');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/products', [TransactionController::class, 'products'])->name('user.products');
    Route::get('/cart', [TransactionController::class, 'cart'])->name('user.cart');
    Route::post('/cart/add/{product}', [TransactionController::class, 'addToCart'])->name('user.cart.add');
    Route::put('/cart/update/{id}', [TransactionController::class, 'updateCart'])->name('user.cart.update');
    Route::delete('/cart/remove/{id}', [TransactionController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::delete('/cart/clear', [TransactionController::class, 'clearCart'])->name('user.cart.clear');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('user.checkout');
    Route::get('/history', [TransactionController::class, 'history'])->name('user.history');

    Route::get('/faq', function () {
        return view('user.faq');
    })->name('user.faq');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';