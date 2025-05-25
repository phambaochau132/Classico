<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;

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
Route::get('/product/order_by', [ProductController::class, 'get_products'])->name('product.order_by');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
// Route::get('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');

//Payment
Route::get('/payment/index', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/review', [PaymentController::class, 'review'])->name('payment.review');
Route::post('/payment/delivery', [PaymentController::class, 'delivery'])->name('payment.delivery');
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
Route::post('/payment/transfer/{content}', [PaymentController::class, 'orderTransfer'])->name('payment.order_transfer');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

//Profile Customer
Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

//Admin
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');

//crud customers
Route::resource('customers', CustomerController::class)->middleware('auth');

//login admin
use App\Http\Controllers\AuthController;

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');




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