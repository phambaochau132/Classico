<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');

//crud customers
use App\Http\Controllers\CustomerController;

Route::resource('customers', CustomerController::class);

//login admin
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




use App\Http\Controllers\AdminUserController;

// Admin Users
Route::resource('admin', AdminUserController::class);

// Route::get('/admin', [AdminUserController::class, 'index']);

// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.users');

// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.users');


// Route::resource('admin', AdminUserController::class);
// Route::get('/admin', [AdminUserController::class, 'index'])->name('admin.index');
// Route::get('/admin/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.edit');
// Route::put('/admin/{id}', [AdminUserController::class, 'update'])->name('admin.update');
// Route::delete('/admin/{id}', [AdminUserController::class, 'destroy'])->name('admin.destroy');



