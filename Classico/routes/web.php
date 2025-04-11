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

//change password
use App\Http\Controllers\Auth\ChangePasswordController;

Route::get('/change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

use App\Http\Controllers\AdminController; // hoặc controller bạn dùng

Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('password.change');
