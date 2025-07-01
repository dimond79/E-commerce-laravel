<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\auth\AuthenticationController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\frontend\HomeController;

use App\Http\Controllers\frontend\AuthenticationController as SiteAuthenticationController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\WishlistController;

// 404 is error resource not found

// login page & auth
Route:: get('/admin/login',[AuthenticationController::class, 'showLogin'])->name('login.page');
Route:: get('/forget-password', [AuthenticationController::class, 'showForgetPassword'])->name('forget.password');
Route::post('/admin/login',[AuthenticationController::class,'login'])->name('admin.login');


//dashboard route goes here
Route::middleware(['auth','is_admin'])->group(function(){
    Route:: get('/admin',[DashboardController::class,'home'])->name('admin.home');

    //Logout
    Route::post('/admin/logout',[AuthenticationController::class,'logout'])->name('admin.logout');

    // Route:: get('/', [Homecontroller::class,'index']);


    //products route
    Route:: get('/admin/products',[ProductController::class, 'index'])->name('admin.product');
    Route:: get('admin/create-product',[ProductController::class, 'createProduct'])->name('create.product');
    Route:: post('/product/store',[ProductController::class, 'store'])->name('product.store');

    //edit the product details
    Route::get('/admin/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::put('/products/{id}/update',[ProductController::class,'update'])->name('product.update');

    //delete product
    Route::delete('/products/{id}/delete',[ProductController::class, 'delete'])->name('product.delete');

    //add category
    Route::get('/admin/product/category',[CategoryController::class,'index'])->name('category.show');
    Route::post('/admin/category/add',[CategoryController::class, 'add'])->name('category.add');
    //edit and update category
    Route::get('/category/{id}/edit',[CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}/update',[CategoryController::class, 'update'])->name('category.update');
    //delete category
    Route::delete('/category/{id}/delete',[CategoryController::class,'delete'])->name('category.delete');


    //Users
    Route::get('/admin/users',[UserController::class,'index'])->name('user.show');



});


//frontend routes goes here


Route::get('/',[HomeController::class, 'index'])->name('site.home');


//Auth route(site)
// Login/ Register
Route::get('/login',[HomeController::class, 'login'])->name('login.register');
Route::post('/register',[SiteAuthenticationController::class, 'register'])->name('user.register');

Route::post('/login',[SiteAuthenticationController::class, 'login'])->name('user.login');
Route::post('/logout',[SiteAuthenticationController::class, 'logout'])->name('user.logout');

//wishlist routes
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.page');
Route::post('/wishlist/toggle',[WishlistController::class,'wishlistToggle'])->name('wishlist.toggle');


//cart routes
Route::get('/cart-items',[CartController::class, 'viewCart'])->name('show.cart.item');
Route::post('/cart/add',[CartController::class, 'addToCart'])->name('add.to.cart');


Route::get('/test',function(){
    return "this is test page";
})->name('test');
