<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminStockMovementController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('admin')->name('admin.')->group(function() {

    Route::middleware('isAdmin')->group(function() {
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('index', 'admin.index')->name('index');
    }); 


    // Products routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
        Route::get('/create-product', [AdminProductController::class, 'create'])->name('product.create');
        Route::post('/store-product', [AdminProductController::class, 'store'])->name('product.store');
        Route::get('/edit-product/{product}', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::post('/update-product/{product}', [AdminProductController::class, 'update'])->name('product.update');
        Route::delete('/destroy-product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');
    });

    // Customers routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customer.index');
        Route::get('/create-customer', [AdminCustomerController::class, 'create'])->name('customer.create');
        Route::post('/store-customer', [AdminCustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit-customer/{customer}', [AdminCustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/update-customer/{customer}', [AdminCustomerController::class, 'update'])->name('customer.update');
        Route::delete('/destroy-customer/{customer}', [AdminCustomerController::class, 'destroy'])->name('customer.destroy');
    });

    // Stock Movements routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('/stock-movements/{product}', [AdminStockMovementController::class, 'index'])->name('stock-movement.index');
        Route::get('/create-stock-movement', [AdminStockMovementController::class, 'create'])->name('stock-movement.create');
        Route::post('/store-stock-movement/{product}', [AdminStockMovementController::class, 'store'])->name('stock-movement.store');
        Route::get('/edit-stock-movement/{stock-movement}', [AdminStockMovementController::class, 'edit'])->name('stock-movement.edit');
        Route::post('/update-stock-movement/{stock-movement}', [AdminStockMovementController::class, 'update'])->name('stock-movement.update');
        Route::delete('/destroy-stock-movement/{stock-movement}', [AdminStockMovementController::class, 'destroy'])->name('stock-movement.destroy');
    });

    // Orders routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('order.index');
        Route::get('/create-order', [AdminOrderController::class, 'create'])->name('order.create');
        Route::post('/store-order/{product}', [AdminOrderController::class, 'store'])->name('order.store');
        Route::get('/edit-order/{order}', [AdminOrderController::class, 'edit'])->name('order.edit');
        Route::post('/update-order/{order}', [AdminOrderController::class, 'update'])->name('order.update');
        Route::delete('/destroy-order/{order}', [AdminOrderController::class, 'destroy'])->name('order.destroy');
    });

    require __DIR__.'/admin_auth.php';
});






