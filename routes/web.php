<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController as CategoryAdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UserController as UserAdminController;
use App\Http\Controllers\Admin\MainController as MainAdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\Product\DetailProductController;
use App\Http\Controllers\Admin\Product\ProductController as ProductAdminController;
use App\Http\Controllers\Admin\Product\ThumbController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserController as UserMainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\User\CheckOutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->group(function () {
    #Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    #Forget password
    Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget_password.get');
    Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget_password.post');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset_password.get');
    Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset_password.post');

    #Register
    Route::get('/registration', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/registration', [AuthController::class, 'register'])->name('register.post');

    #Verify Email
    Route::get('/account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('verify_user');
});

Route::middleware(['auth', 'verify_email'])->group(function () {
    #Change Password
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change_password');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('update_password');
});

#trang admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verify_email'])->group(function () {
    #Trang chủ
    Route::get('/', [MainAdminController::class, 'index'])->name('index');

    #Người dùng
    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::post('/users/changeStatus', [UserAdminController::class, 'changeStatus'])->name('users.change_status');

    #Danh muc
    Route::resource('categories', CategoryAdminController::class);
    #Banner
    Route::resource('sliders', SliderController::class);
    Route::post('/sliders/changeStatus', [SliderController::class, 'changeStatus'])->name('sliders.change_status');
    #Nhan hang cung cap
    Route::resource('brands', BrandController::class);
    Route::post('/brands/changeStatus', [BrandController::class, 'changeStatus'])->name('brands.change_status');
    #Ma giam gia
    Route::resource('vouchers', VoucherController::class);

    #Send voucher
    Route::post('/availabe-recipient', [VoucherController::class, 'getAvailCustomers'])->name('get_availabe_recipient');
    Route::post('/give-voucher', [VoucherController::class, 'giveVoucher'])->name('give_voucher');
    Route::prefix('product')->name('product.')->group(function () {
        Route::resource('products', ProductAdminController::class);
        Route::resource('products/{product}/thumb', ThumbController::class);
        Route::resource('products/{product}/detail', DetailProductController::class);
    });

    #Order
    Route::resource('orders', OrderController::class);
    Route::post('/orders/changeStatus', [OrderController::class, 'changeStatus'])->name('orders.change_status');
});
#trang user
Route::prefix('/')->group(function () {
    #trang chu
    Route::get('/', [MainController::class, 'index'])->name('homepage');
    #trang thong tin gioi thieu
    Route::get('/gioi-thieu', [MainController::class, 'intro'])->name('intro');
    #trang lien he
    Route::get('/lien-he', [MainController::class, 'contact'])->name('contact');
    #trang thanh toan
    Route::post('/dat-hang', [CartController::class, 'checkout'])->name('checkout');
    // #trang gio hang
    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    #ajax cap nhat so luong trong gio hang
    Route::put('/gio-hang', [CartController::class, 'update'])->name('cart.update');
    #ajax xu ly su dung ma giam gia
    Route::post('/gio-hang', [CartController::class, 'voucher'])->name('use.voucher');
    #ajax xoa gio hang
    Route::delete('/gio-hang', [CartController::class, 'destroy'])->name('delcart');
    #trang cap nhat tai khoan
    Route::get('/thong-tin-tai-khoan', [UserMainController::class, 'account'])->name('account');
    Route::put('/thong-tin-tai-khoan', [UserMainController::class, 'updateAddress'])->name('updateAddress');
    Route::put('/thong-tin-tai-khoan/update', [UserMainController::class, 'updateUser'])->name('updateUser');

    #checkout
    Route::prefix('checkout')->group(function () {
        Route::get('/process', [CheckOutController::class, 'processPayment'])->name('processPayment');
        Route::get('/result', [CheckOutController::class, 'result'])->name('result');
        Route::get('/vnPayCheck', [CheckOutController::class, 'vnPayCheck'])->name('vnPayCheck');
    });


    #trang quan ly ma giam gia
    Route::get('/vi-voucher', [UserMainController::class, 'wallet'])->name('wallet');
    #trang quan ly don hang
    Route::get('/don-hang', [UserMainController::class, 'order'])->name('order');
    #trang thong tin san pham
    Route::get('/san-pham/{product}', [ProductController::class, 'product'])->name('product');
    #lay mau theo size
    Route::post('/san-pham', [ProductController::class, 'getColor'])->name('product.size');
    #them san pham vao gio hang
    Route::post('/san-pham/{product}', [CartController::class, 'store'])->name('addCart');
    #Chon size va mau san pham
    Route::post('/san-pham', [ProductController::class, 'getColor'])->name('product.size');

    //Hiện thị thêm sản phẩm
    Route::post('/services/load-product', [ProductController::class, 'loadProduct']);

    //Hiển thị sản phẩm
    Route::get('/danh-muc/{category:slug}', [ProductController::class, 'index'])->name('category_filter');
    #ajax xoa gio hang
    Route::delete('/gio-hang', [CartController::class, 'destroy'])->name('delcart');

    Route::post('/services/load-product', [ProductController::class, 'loadProduct']);

    //Hiển thị sản phẩm
    Route::get('/danh-muc/{category:slug}', [ProductController::class, 'index'])->name('category_filter');
    Route::get('/search-product', [ProductController::class, 'search_products'])->name('search_products');
    Route::get('/filter-by', [ProductController::class, 'filter_by'])->name('filter_by');
});
