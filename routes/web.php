<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminUserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Customer Auth Routes
|--------------------------------------------------------------------------
*/

// Auth & Public Routes
Route::prefix('/')->group(function () {
    // Customer Auth Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('customer.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('customer.register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('customer.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('customer.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');

    // Redirect /index → /
    Route::redirect('/index', '/');
});

// Protected Routes (only for logged-in customers)
// Route::middleware(['auth:customer'])->group(function () {
Route::get('/', [ProductController::class, 'index'])->name('customer.home');
Route::get('/product/all', [ProductController::class, 'all'])->name('product.all');
Route::get('/product', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/order_by', [ProductController::class, 'get_products'])->name('product.order_by');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/productCategorie', [ProductController::class, 'productCategorie'])->name('product.cate');


Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
// });
/*
|--------------------------------------------------------------------------
| Social Login (Google, Facebook)
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::prefix('admin')->group(function () {
    // Welcome
    Route::get('/', function () {
        return view('welcome');
    });

    // Auth admin
    Route::get('/login', [AuthController::class, 'showLoginAdminForm'])->name('admin.login');
    Route::post('/login_form', [AuthController::class, 'loginAdmin'])->name('admin.loginForm');
    Route::get('/logout', [AuthController::class, 'logoutAdmin'])->name('adminlogout');


    // Orders

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/order', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Products
    Route::get('/products/index', [ProductController::class, 'allProduct'])->name('products.allProduct');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Admin Users
    Route::resource('/', AdminUserController::class); // Route::resource('admin', ...) vẫn đúng vì đang ở trong prefix('admin')
    Route::resource('customers', CustomerController::class);
    // Admin quản lý khách hàng
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
});



/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
*/
Route::get('/payment/index', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/review', [PaymentController::class, 'review'])->name('payment.review');
Route::post('/payment/delivery', [PaymentController::class, 'delivery'])->name('payment.delivery');
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
Route::post('/payment/transfer/{content}', [PaymentController::class, 'orderTransfer'])->name('payment.order_transfer');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

/*
|--------------------------------------------------------------------------
| CRUD Customers (Admin)
|--------------------------------------------------------------------------
*/
