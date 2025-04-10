<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');


use App\Http\Controllers\CustomerController;

Route::resource('customers', CustomerController::class);
