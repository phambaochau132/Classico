<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;


Route::get('/', [ProductController::class, 'index']);
Route::get('/product/all', [ProductController::class, 'all'])->name('product.all');
Route::get('/product', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');