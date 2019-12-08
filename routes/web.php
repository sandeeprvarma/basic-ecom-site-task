<?php

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

// Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes();
Route::group(['middleware'=>['users_only']],function () {
	Route::get('/home', 'UserController@index')->middleware('');
	Route::get('add-to-cart/{id}', 'UserController@addToCart');
	Route::get('cart', 'UserController@cart');
	Route::get('remove-cart/{id}', 'UserController@removeCart');
	Route::get('checkout', 'UserController@checkout');
	Route::get('place-order','UserController@placeOrder');
});


Route::group(['middleware'=>['is_admin'],'prefix'=>'admin'], function () {
	Route::get('', 'AdminController@admin');
	Route::get('products', 'AdminController@products');
	Route::get('category', 'AdminController@category');
	Route::post('addcategory',  array('as' => 'addcategory','uses'=>'AdminController@addCategory'));
	Route::post('addproduct', array('as' => 'addproduct','uses'=>'AdminController@addProducts'));
});


