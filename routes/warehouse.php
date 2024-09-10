<?php


use App\Http\Controllers\Warehouse\WarehouseOrderController;
use App\Livewire\Warehouse\OrderPickup;
use App\Livewire\Warehouse\OrderReturn;
use App\Livewire\Warehouse\ProductIndex;
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


Route::prefix('warehouse')->name('warehouse.')->group(function() {

    Route::middleware('isWarehouse')->group(function() {
        Route::view('dashboard', 'warehouse.dashboard')->name('dashboard');
    }); 


    // Products routes
    Route::middleware('isWarehouse')->group(function () {
        Route::get('/products', ProductIndex::class)->name('product.index');

    });

    // Pick up order routes
    Route::middleware('isWarehouse')->group(function () {

        Route::get('/pick-up-orders', OrderPickup::class)->name('pick_up_order');

    });


    // Return order routes
    Route::middleware('isWarehouse')->group(function () {
        Route::get('/return-orders', OrderReturn::class)->name('return_order');

    });


});






