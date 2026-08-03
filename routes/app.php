<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/cart', [MenuController::class, 'cart'])->name('cart');
Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [MenuController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [MenuController::class, 'removeCart'])->name('cart.remove');
Route::get('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');

Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout');
Route::post('/checkout/store', [MenuController::class, 'storeOrder'])->name('checkout.store');
Route::get('/checkout/success/{orderId}', [MenuController::class, 'checkoutSuccess'])->name('checkout.success');


// admin routes
Route::middleware('role:admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('admiphp artisan db:seedn/tables', [QrCodeController::class, 'index'])->name('admin.tables.index');
    Route::post('admin/tables', [QrCodeController::class, 'store'])->name('admin.tables.store');
    Route::get('admin/tables/{id}/print', [QrCodeController::class, 'print'])->name('admin.tables.print');
    Route::delete('admin/tables/{id}', [QrCodeController::class, 'destroy'])->name('admin.tables.destroy');
});

Route::middleware('role:admin|cashier|chef')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class);
    Route::post('items/update-status/{order}', [ItemController::class, 'updateStatus'])->name('items.updateStatus');
    Route::resource('items', ItemController::class);
    Route::post('orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('admin/tables/qrcode', [QrCodeController::class, 'index'])->name('admin.tables.qrcode');
    Route::get('admin/tables/{tableId}/qrcode', [QrCodeController::class, 'preview'])->name('admin.tables.qrcode.preview');
    Route::get('admin/tables/{tableId}/qrcode.svg', [QrCodeController::class, 'generate'])->name('admin.tables.qrcode.generate');
});






