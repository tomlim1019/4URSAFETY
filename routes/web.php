<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'staff'])->group(function () {
    Route::resource('categories', 'CategoriesController');
    Route::resource('products', 'ProductsController')->except(['show']);
    Route::resource('quotations', 'QuotationsController')->except(['show']);
    Route::resource('logs', 'PurchaseLogsController')->except(['show']);
    Route::get('/report', 'ReportController@index')->name('staff.report');
    Route::put('/products/{product}/status', 'ProductsController@updateStatus')->name('product.status');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/product', 'ProductsController@customerIndex')->name('customer.product');
    Route::get('/request', 'QuotationsController@customerIndex')->name('customer.request');
    Route::get('/myproduct', 'PurchaseLogsController@customerIndex')->name('customer.log');
    Route::put('/profile/picture/{user}', 'HomeController@uploadPicture')->name('upload.picture');
    Route::put('/password/{user}', 'HomeController@resetPassword');
    Route::put('/profile/document/{user}', 'HomeController@uploadDocument')->name('upload.document');
    Route::put('/profile/request/{user}', 'HomeController@submitApproval');
    Route::get('/products/{product}', 'ProductsController@show')->name('products.show');
    Route::get('/quotations/{quotation}', 'QuotationsController@show')->name('quotations.show');
    Route::get('/logs/{log}', 'PurchaseLogsController@show')->name('logs.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::put('/customer/password/{user}', 'UsersController@resetPassword');
    Route::put('/staff/{user}', 'UsersController@editStaffRole');
    Route::delete('/staff/{user}', 'UsersController@deleteStaff');
    Route::put('/customer/{user}', 'UsersController@customerApproval');
    Route::delete('/customer/{user}', 'UsersController@deleteCustomer');
    Route::get('/customer', 'UsersController@customerIndex')->name('customer');
    Route::get('/staff', 'UsersController@staffIndex')->name('staff');
    Route::get('/customer/{user}/edit', 'UsersController@editCustomer')->name('customer.edit');
    Route::get('/staff/{user}/edit', 'UsersController@editStaff')->name('staff.edit');
    Route::post('/staff', 'UsersController@createStaff')->name('register.staff');
  });