<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart/update/{id}',[CartController::class,'update'])->name('cart.update');
Route::post('/cart/create/{id}',[CartController::class,'create'])->name('cart.create');
Route::get('/cart/delete/{id}',[CartController::class,'delete'])->name('cart.delete');