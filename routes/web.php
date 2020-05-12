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


Route::get('/larafirebase','FirebaseController@index');

Route::get('/login','LoginController@login')->name('login');

Route::post('/login-verify','LoginController@loginVerify')->name('loginVerify');

Route::post('/register-user','LoginController@registerUser')->name('registerUser');

Route::get('/register','LoginController@register')->name('register');

Route::get('/home','LoginController@home')->name('home');

Route::get('/logout','LoginController@logout')->name('logout');

Route::get('/dashboard','FirebaseController@dashboard')->name('dashboard'); 

Route::get('/add-product','FirebaseController@addProduct')->name('addProduct');

Route::get('/save-wishlist/{id}','FirebaseController@saveWishlist')->name('saveWishlist');

Route::get('/wishlist','FirebaseController@showWishlist')->name('showWishlist');

Route::get('/add-cart/{id}','FirebaseController@addToCart')->name('addToCart');

Route::get('/cart','FirebaseController@showCart')->name('showCart');
