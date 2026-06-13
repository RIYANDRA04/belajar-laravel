<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// Guest & Home Route
// ─────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ─────────────────────────────────────────────
// Auth Routes
// ─────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─────────────────────────────────────────────
// Frontend Routes (Protected by Auth)
// ─────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/shoe/{id}', [ShopController::class, 'show'])->name('shoe.show');

    // Cart (session-based, but now requires auth to access)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/initiate-midtrans', [CheckoutController::class, 'initiateMidtrans'])->name('checkout.initiate-midtrans');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

    // My Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Midtrans Webhook Callback (Public, excluded from CSRF)
Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransCallbackController::class, 'handle'])->name('midtrans.callback');

// ─────────────────────────────────────────────
// Admin Routes (protected by Auth & IsAdmin)
// ─────────────────────────────────────────────
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ─── Chunked image upload — must be BEFORE resource() to avoid {product} wildcard ───
    Route::post('products/upload-chunk',    [AdminProductController::class, 'uploadChunk'])->name('admin.products.upload-chunk');
    Route::post('products/finalize-upload', [AdminProductController::class, 'finalizeUpload'])->name('admin.products.finalize-upload');
    Route::get('products/cloudinary-signature', [AdminProductController::class, 'cloudinarySignature'])->name('admin.products.cloudinary-signature');

    Route::resource('products', AdminProductController::class)
        ->names([
            'index'   => 'admin.products.index',
            'create'  => 'admin.products.create',
            'store'   => 'admin.products.store',
            'show'    => 'admin.products.show',
            'edit'    => 'admin.products.edit',
            'update'  => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});

// helper route /run-migration removed for production security

