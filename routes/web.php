<?php

use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Livewire\Users\Dashboard;
use App\Livewire\Users\MarketplaceIndex;
use App\Livewire\Users\OrderCreate;
use App\Livewire\Users\OrderIndex;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', [SettingController::class, 'profile'])->name('setting.profile');
    Route::get('/wallet', [SettingController::class, 'wallet'])->name('setting.wallet');
});


// Marketplace routes
Route::middleware('auth')->group(function () {
    Route::get('/marketplace', MarketplaceIndex::class)->name('marketplace.index');
    Route::get('/marketplace/{product}', [MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::post('/marketplace-start-selling/{product}', [MarketplaceController::class, 'start_selling'])->name('marketplace.start_selling');

});

// Products routes
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update-product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/destroy-product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// Orders routes
Route::middleware('auth')->group(function () {
    Route::get('/orders', OrderIndex::class)->name('order.index');
    Route::get('/order/create', OrderCreate::class)->name('order.create'); 
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/cancel-order/{order}', [OrderController::class, 'cancel'])->name('order.cancel');

});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/moderator.php';
require __DIR__.'/warehouse.php';
