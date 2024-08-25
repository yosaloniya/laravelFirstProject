<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubskuController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SupplierproductController;
use App\Http\Controllers\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('forgot-password', [CustomAuthController::class, 'forgotpass'])->name('forgotpasspage');
Route::post('forgot-password', [CustomAuthController::class, 'cheack_email']);
Route::get('verify-otp/{id}', [CustomAuthController::class, 'validateotp'])->name('varifyotp');
Route::post('verify-otp/{id}', [CustomAuthController::class, 'otp_varification'])->name('varificationOtp');
Route::get('change-password/{id}', [CustomAuthController::class, 'changepass'])->name('changepass');
Route::post('change-password/{id}', [CustomAuthController::class, 'updatepass'])->name('updatepass');
Route::get('verify-otp/{userId}', [CustomAuthController::class, 'validateotp'])->name('verify-otp');
Route::get('resend-otp/{id}', [CustomAuthController::class, 'resendOtp'])->name('resend-otp');




Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

    // Users.....
    Route::get('users',[UsersController::class, 'index']);
    Route::post('users/info',[UsersController::class, 'info']);
    Route::post('users/data',[UsersController::class, 'data']);
    Route::post('users/update',[UsersController::class, 'update']);
    Route::get('users/delete/{id}',[UsersController::class,'delete']);
    Route::get('users/status/{id}',[UsersController::class,'status']);

    // brand.....
    Route::get('brand/info',[BrandController::class, 'info']);
    Route::get('brand',[BrandController::class, 'index']);
    Route::get('brand/edit/{id}',[BrandController::class, 'edit']);
    Route::POST('brand/edit/{id}',[BrandController::class, 'edit1']);
    Route::get('brand/delete/{id}',[BrandController::class, 'delete']);
    Route::post('brand/info',[BrandController::class, 'save']);
    Route::get('brand/status/{id}',[BrandController::class, 'status']);



// category.....
Route::get('category',[CategoryController::class,'index']);
Route::get('category/info',[CategoryController::class, 'info']);
Route::get('category/edit/{id}',[CategoryController::class, 'edit']);
Route::POST('category/edit/{id}',[CategoryController::class, 'edit1']);
Route::get('category/delete/{id}',[CategoryController::class, 'delete']);
Route::post('category/info',[CategoryController::class, 'save']);
Route::get('category/status/{id}',[CategoryController::class, 'status']);

// Product.....
Route::get('products',[ProductController::class,'index']);
Route::get('products/info',[ProductController::class,'info']);
Route::post('products/info',[ProductController::class, 'save']);
Route::get('products/edit/{id}',[ProductController::class,'edit']);
Route::post('products/edit/{id}',[ProductController::class,'edit1']);
Route::get('products/delete/{id}',[ProductController::class,'delete']);
Route::get('products/status/{id}',[ProductController::class,'status']);


Route::post('sku/data',[ProductController::class,'data']);

// SUbsku.....
Route::get('subsku/info/{id}',[SubskuController::class,'info']);
Route::post('subsku/info/{id}',[SubskuController::class,'save']);
Route::get('subsku/{id}',[SubskuController::class,'index']);
Route::get('subsku/delete/{id}',[SubskuController::class,'delete']);
Route::get('subsku/edit/{id}',[SubskuController::class,'edit']);
Route::post('subsku/edit/{id}',[SubskuController::class,'edit1']);
Route::get('subsku/status/{id}',[SubskuController::class,'status']);


// Sales.....
Route::get('orders',[SalesController::class,'index']);
Route::get('orders/info',[SalesController::class,'info']);
Route::post('orders/save',[SalesController::class,'save']);
Route::get('orders/edit/{id}',[SalesController::class,'edit']);
Route::post('orders/update',[SalesController::class,'update']);
Route::get('orders/status/{id}',[SalesController::class,'status']);
Route::get('orders/delete/{id}',[SalesController::class,'delete']);
Route::get('orders/generate-bill/{id}',[SalesController::class,'pdf'])->name('pdf');
Route::post('product/subsku',[SalesController::class,'subsku']);
Route::post('product/price',[SalesController::class,'price']);
Route::post('product/getPrice',[SalesController::class,'getPrice']);

// customers...
Route::get('customers',[CustomersController::class,'index']);
Route::post('customers/info',[CustomersController::class,'info']);
Route::post('customers/data',[CustomersController::class,'data']);
Route::post('customers/update',[CustomersController::class,'update']);
Route::get('customers/status/{id}',[CustomersController::class,'status']);
Route::get('customers/delete/{id}',[CustomersController::class,'delete']);
Route::get('customers/orders/{id}',[CustomersController::class,'customersorder']);
Route::post('customers/data/info',[CustomersController::class,'customerdatainfo']);

// Suppliers.....
Route::get('suppliers',[SupplierController::class,'index']);
Route::post('suppliers/info',[SupplierController::class,'info']);
Route::post('suppliers/data',[SupplierController::class,'data']);
Route::post('suppliers/update',[SupplierController::class,'update']);
Route::get('suppliers/delete/{id}',[SupplierController::class,'delete']);
Route::get('suppliers/status/{id}',[SupplierController::class,'status']);
Route::post('suppliers/products/info',[SupplierController::class,'sup_products']);

// Supplierproduct
Route::get('supplierproducts',[SupplierproductController::class,'index']);
Route::get('supplierproducts/info',[SupplierproductController::class,'info']);
Route::post('supplierproducts/save',[SupplierproductController::class,'save']);
Route::get('supplierproducts/edit/{id}',[SupplierproductController::class,'edit']);
Route::post('supplierproducts/edit/{id}',[SupplierproductController::class,'update']);
Route::get('supplierproducts/delete/{id}',[SupplierproductController::class,'delete']);
Route::post('supplierproduct/name',[SupplierproductController::class,'productname']);

});




