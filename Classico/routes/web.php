<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Order routes
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/order', [OrderController::class, 'show'])->name('orders.show');

// Category routes
Route::resource('categories', CategoryController::class);
