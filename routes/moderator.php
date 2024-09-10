<?php


use App\Http\Controllers\Moderator\ModeratorOrderController;
use App\Livewire\Moderators\OrderConfirm;
use App\Livewire\Moderators\OrderIndex;
use App\Livewire\Moderators\OrderManagers\OrderManagementIndex;
use App\Livewire\Moderators\OrderManagers\OrderManagementOneByOne;
use App\Livewire\Moderators\OrderManagers\OrderManagementSearch;
use App\Livewire\Moderators\OrderManagers\OrderManagementShow;
use App\Livewire\Moderators\OrderShippingUpload;
use App\Livewire\Moderators\OrderShow;
use App\Livewire\Moderators\Teamleaders\ConfirmationTeamOrderIndex;
use App\Livewire\Moderators\Teamleaders\OrderIndex as TeamleadersOrderIndex;
use App\Livewire\Moderators\Teamleaders\OrderShow as TeamleadersOrderShow;
use App\Livewire\Moderators\Teamleaders\ShippingTeamOrderIndex;
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


Route::prefix('moderator')->name('moderator.')->group(function() {

    Route::middleware('isModerator')->group(function() {
        Route::view('dashboard', 'moderator.dashboard')->name('dashboard');
        Route::view('index', 'moderator.index')->name('index');
    }); 


    // Orders routes
    Route::middleware('isModerator')->group(function () {
        Route::get('/orders', OrderIndex::class)->name('order.index');
        Route::get('/order/{order}', OrderShow::class)->name('order.show');
        Route::get('/order-edits/{order}', [ModeratorOrderController::class, 'order_edits'])->name('order.order_edits');

        
        Route::get('/create-order', [ModeratorOrderController::class, 'create'])->name('order.create');
        Route::post('/store-order/{product}', [ModeratorOrderController::class, 'store'])->name('order.store');
        Route::get('/edit-order/{order}', [ModeratorOrderController::class, 'edit'])->name('order.edit');
        Route::post('/update-order/{order}', [ModeratorOrderController::class, 'update'])->name('order.update');
        Route::delete('/destroy-order/{order}', [ModeratorOrderController::class, 'destroy'])->name('order.destroy');
    });

    // Confirm Orders routes
    Route::middleware('isModerator')->group(function () {
        Route::get('/confirm-orders', OrderConfirm::class)->name('confirm_orders.index');
    });

    // Upload Shipping Orders routes
    Route::middleware('isModerator')->group(function () {
        Route::get('/shipping-upload-orders', OrderShippingUpload::class)->name('shipping_upload_orders.index');
    });

    // Team leader (Moderator) routes
    Route::middleware('isModeratorTeamLeader')->group(function () {
        Route::view('/team-leader/dashboard', 'moderator_team_leader.dashboard')->name('teamleader.dashboard');
        Route::get('/team-leader/confirmation-team-orders', ConfirmationTeamOrderIndex::class)->name('confirmation_team_orders.index');
        Route::get('/team-leader/shipping-team-orders', ShippingTeamOrderIndex::class)->name('shipping_team_orders.index');
        Route::get('/team-leader/order/{order}', TeamleadersOrderShow::class)->name('team_leader_order.show');
    });

    // Order Mnaager (Moderator) routes
    Route::middleware('isModeratorOrderManager')->group(function () {
        Route::view('/order-manager/dashboard', 'order_manager.dashboard')->name('order_management.dashboard');
        Route::get('/order-manager/all-orders', OrderManagementIndex::class)->name('order_management.index');
        Route::get('/order-manager/{order}', OrderManagementShow::class)->name('order_management.show');
        Route::get('/order-manager/search-order', OrderManagementSearch::class)->name('order_management.search');
        Route::get('/order-manager/order-by-order', OrderManagementOneByOne::class)->name('order_management.onebyone');
    });
});






