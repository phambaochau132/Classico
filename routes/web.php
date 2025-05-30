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
use App\Http\Controllers\HistoryOrderController;
use App\Http\Controllers\WarehouseController;
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

    Route::get('/redirect-login', function () {
        return redirect()->route('customer.login.form');
    })->name('login');
    // Redirect /index → /
    Route::redirect('/index', '/');
});

// Protected Routes (only for logged-in customers)
Route::middleware(['auth:customer'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('customer.home');
    Route::get('/product/all', [ProductController::class, 'all'])->name('product.all');
    Route::get('/product', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/order_by', [ProductController::class, 'get_products'])->name('product.order_by');
    Route::get('/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/productCategorie', [ProductController::class, 'productCategorie'])->name('product.cate');


    Route::get('/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
});
/*
|--------------------------------------------------------------------------
| Social Login (Google, Facebook)
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);


// Welcome
Route::get('/admin', function () {
    return view('welcome');
});

// Auth admin
Route::get('/admin/login', [AuthController::class, 'showLoginAdminForm'])->name('admin.login');
Route::post('/admin/login_form', [AuthController::class, 'loginAdmin'])->name('admin.loginForm');
Route::get('/admin/logout', [AuthController::class, 'logoutAdmin'])->name('admin.logout');


//kho 
Route::get('/admin/warehouse', [WarehouseController::class, 'dashboard'])->name('warehouse');
Route::post('/admin/warehouse/update', [WarehouseController::class, 'update'])->name('warehouse.update');
Route::post('/admin/warehouse/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit'); // nếu có

//oder
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/admin/order', [OrderController::class, 'show'])->name('orders.show');
Route::post('/admin/orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


// Hiển thị danh sách khách hàng
Route::get('admin/customers', [CustomerController::class, 'index'])->name('customers.index');


// Lưu thông tin khách hàng mới
Route::post('admin/customers/store', [CustomerController::class, 'store'])->name('customers.store');


// Xoá khách hàng
Route::delete('admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

//oday
// Hiển thị chi tiết danh mục
Route::get('/admin/categories/{customer}/show', [CategoryController::class, 'show'])->name('categories.show');
// Categories
// Danh sách danh mục
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');

// Hiển thị form tạo mới danh mục
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');

// Lưu danh mục mới
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');


// Hiển thị form chỉnh sửa danh mục
Route::get('/admin/categories/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Cập nhật danh mục (PUT hoặc PATCH)
Route::put('/admin/categories/update', [CategoryController::class, 'update'])->name('categories.update');

// Xóa danh mục
Route::delete('/admin/categories/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Admin Users
Route::get('/admin/reset-password', [AdminUserController::class, 'showResetForm'])->name('reset.form');
Route::resource('admin', AdminUserController::class); // Route::resource('admin', ...) vẫn đúng vì đang ở trong prefix('admin')

// Admin quản lý khách hàng

Route::get('/admin/reset-password', [AdminUserController::class, 'showResetForm'])->name('reset.form');
Route::post('/admin/reset-password', [AdminUserController::class, 'handleReset'])->name('reset.handle');


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
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/confirmOrder', [PaymentController::class, 'confirmOrder'])->name('payment.confirmOrder');
Route::get('/payment/review', [PaymentController::class, 'review'])->name('payment.review');
Route::post('/payment/delivery', [PaymentController::class, 'delivery'])->name('payment.delivery');
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
Route::post('/payment/transfer/{content}', [PaymentController::class, 'orderTransfer'])->name('payment.order_transfer');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
/*
/*
|--------------------------------------------------------------------------
| History Order Routes
|--------------------------------------------------------------------------
*/
Route::get('/history', [HistoryOrderController::class, 'index'])->name('history.index');
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
Route::middleware(['auth:web'])->group(function () {
    Route::get('admin/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::get('admin/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');

// Cập nhật thông tin khách hàng
Route::put('admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::patch('admin/customers/{customer}', [CustomerController::class, 'update']);


Route::get('/admin/dashboard', function () {
    return view('dashboard'); // bạn có thể tạo view resources/views/dashboard.blade.php
})->name('dashboard');

//thong ke san pham
Route::get('admin/products/statistics', [ProductController::class, 'statistics'])->name('products.statistics');

//thong ke doanh thu
Route::get('admin/orders/report-revenue', [OrderController::class, 'reportRevenue'])->name('orders.reportRevenue');

//thong ke đơn hàng
Route::get('admin/orders/report', [OrderController::class, 'reportOrders'])->name('orders.report');

// Products
Route::get('/admin/products/index', [ProductController::class, 'allProduct'])->name('products.allProduct');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/admin/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');


});


// Route::get('/admin/dashboard', function () {
//     return view('dashboard'); // bạn có thể tạo view resources/views/dashboard.blade.php
// })->name('dashboard');

// //thong ke san pham
// Route::get('/products/statistics', [ProductController::class, 'statistics'])->name('products.statistics');

// //thong ke doanh thu
// Route::get('/admin/orders/report-revenue', [OrderController::class, 'reportRevenue'])->name('orders.reportRevenue');

// //thong ke đơn hàng
// Route::get('/admin/orders/report', [OrderController::class, 'reportOrders'])->name('orders.report');
