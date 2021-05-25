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

Route::get('/cus-login', 'CustomerController@viewLogin')->name('login.index');
Route::post('/cus-login', 'CustomerController@submitLogin')->name('login.submit');

Route::get('home-page', 'CustomerController@homePage');
Route::get('logout-cus', 'CustomerController@logoutCus')->name('logout.cus');
Route::get('shop', 'CustomerController@showProduct')->name('product.show');
Route::get('product/{id}', 'CustomerController@showDetail')->name('product.detail');
Route::post('add-cart/{id}', 'CustomerController@addCart')->name('card.add');
// Route::post('add-cart', 'CustomerController@addCart')->name('card.add');
Route::get('cart/checkout', 'CustomerController@showCart')->name('cart.show');
Route::get('data-cart', 'CustomerController@datacart');
Route::get('cart/delete/{id}', 'CustomerController@deleteItemCart')->name('cart.delete');
Route::get('cart/update', 'CustomerController@updateItemCart')->name('cart.update');
// Route::get('update-total', 'CustomerController@updateTotal');
Route::get('show-checkout', 'CustomerController@showCheckoutCart')->name('cart.showcheckout');
// Route::post('checkout', 'CustomerController@checkoutCart')->name('cart.checkout');
// Route::get('test/{id}', 'CustomerController@test');
