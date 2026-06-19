<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLER
|--------------------------------------------------------------------------
*/

// Public User
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;

// Profile
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;


/*
|--------------------------------------------------------------------------
| PUBLIC USER
|--------------------------------------------------------------------------
*/

// Home

Route::get('/', [ProductController::class, 'index']);

Route::get('/products', [ProductController::class, 'all']);

Route::get('/product/{id}', [ProductController::class, 'show']);


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Add Cart
    Route::post('/cart/add', [CartController::class, 'add']);

    // Cart Page
    Route::get('/cart', [CartController::class, 'index']);

    // Checkout
    Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

    // Payment
    // Route::get('/payment/{id}', [PaymentController::class, 'index'])
    //     ->name('payment.index');

    // Route::post('/payment/{id}', [PaymentController::class, 'pay'])
    //     ->name('payment.pay');
    // Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

    Route::post('/cart/plus/{id}', [CartController::class, 'plus']);
    Route::post('/cart/minus/{id}', [CartController::class, 'minus']);

});


/*
|--------------------------------------------------------------------------
| Midtrans Callback
|--------------------------------------------------------------------------
*/

Route::post('/midtrans/callback', [PaymentController::class, 'callback'])
    ->name('midtrans.callback');

/*
|--------------------------------------------------------------------------
| Payment
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/payment/{id}', [PaymentController::class, 'index'])
        ->name('payment.index');

    Route::post('/payment/{id}', [PaymentController::class, 'pay'])
        ->name('payment.pay');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/products', AdminProductController::class);

    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit']);
    Route::put('/products/{id}', [AdminProductController::class, 'update']);
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy']);

    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/pdf',
        [ReportController::class, 'exportPdf']
    )->name('admin.reports.pdf');
});

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/orders', [AdminOrderController::class, 'index']);
        Route::get('/orders/{id}', [AdminOrderController::class, 'show']);

        Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus']);

    });


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

// Route::get('/dashboard', function () {

//     return view('dashboard');

// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';