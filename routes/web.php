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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'HomeController@profile')->name('profile');

Route::get('/profile/edit', 'HomeController@editprofile')->name('editprofile');

Route::post('/test', 'HomeController@test')->name('test');

Route::resource('categories', 'CategoriesController');

Route::resource('products', 'ProductsController');

Route::resource('quotations', 'QuotationsController');

Route::resource('logs', 'PurchaseLogsController');

Route::get('/customer', 'UsersController@customerIndex')->name('customer');

Route::get('/staff', 'UsersController@staffIndex')->name('staff');

Route::get('/customer/{user}/edit', 'UsersController@editCustomer')->name('customer.edit');

Route::get('/staff/{user}/edit', 'UsersController@editStaff')->name('staff.edit');

Route::post('/staff', 'UsersController@createStaff')->name('register.staff');

Route::put('/staff/{user}', 'UsersController@editStaffRole');

Route::delete('/staff/{user}', 'UsersController@deleteStaff');

Route::put('/customer/{user}', 'UsersController@customerApproval');

Route::delete('/customer/{user}', 'UsersController@deleteCustomer');

Route::get('/product', 'ProductsController@customerIndex')->name('customer.product');

Route::get('/request', 'QuotationsController@customerIndex')->name('customer.request');

Route::get('/myproduct', 'PurchaseLogsController@customerIndex')->name('customer.log');