<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['auth', 'Ceklevel:pelelang']], function(){

    Route::livewire('/admin/product', 'product.index')
        ->name('admin.product')
        ->middleware('auth');
});

Route::group(['middleware' => ['auth', 'Ceklevel:peserta_lelang']], function(){    
    Route::livewire('/shop', 'shop.index')
        ->name('shop.index');
    Route::livewire('/cart', 'shop.cart')
        ->name('shop.cart');
    Route::livewire('/checkout', 'shop.checkout')
        ->name('shop.checkout');
    Route::livewire('/bidlist', 'shop.bidlist')
        ->name('shop.bidlist');
    Route::livewire('/detail', 'shop.detail')
        ->name('shop.detail');
    Route::livewire('/lelang', 'shop.lelang');
});