<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;

Route::get('/admin', function () {
    return view('welcome');
});

// Order routes
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/admin/order', [OrderController::class, 'show'])->name('orders.show');
Route::post('/admin/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');



// Category routes
Route::resource('categories', CategoryController::class);



Route::get('/admin/products/index', [ProductController::class, 'allProduct'])->name('products.allProduct');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/admin/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');


Route::get('/register', [CustomerController::class, 'showRegister'])->name('customer.register.form');
Route::post('/register', [CustomerController::class, 'register'])->name('customer.register');
Route::get('/login', [CustomerController::class, 'showLogin'])->name('customer.login.form');
Route::post('/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/product/all', [ProductController::class, 'all'])->name('product.all');
Route::get('/product', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/product/order_by', [ProductController::class, 'get_products'])->name('product.order_by');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

