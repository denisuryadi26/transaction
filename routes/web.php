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

Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function(){
    
    //settings
    Route::group(['middleware' => ['role:admin']], function() {
        Route::resource('setting', 'SettingController');        
    });

    
    
    Route::group(['middleware' => ['permission:manajemen users|manajemen roles']], function() {
        Route::get('/roles/search','RoleController@search')->name('roles.search');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        // Route::resource('setting', 'SettingController');        
    });

    // Produk
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/product/search','ProductController@search')->name('product.search');
        Route::get('/product/pdf','ProductController@reportPdf')->name('product.pdf');
        Route::get('/product/export/', 'ProductController@export')->name('product.export');
        Route::post('/product/import/', 'ProductController@import')->name('product.import');
        Route::resource('product', 'ProductController');        
    });

    // Transaksi
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/transaction/search','TransactionController@search')->name('transaction.search');
        Route::get('/transaction/pdf','TransactionController@reportPdf')->name('transaction.pdf');
        Route::get('/transaction/export/', 'TransactionController@export')->name('transaction.export');
        Route::post('/transaction/import/', 'TransactionController@import')->name('transaction.import');
        Route::post('/transaction/addproduct/{id}', 'TransactionController@addProductCart');
        Route::post('/transaction/removeproduct/{id}', 'TransactionController@removeProductCart');
        Route::post('/transaction/clear', 'TransactionController@clear');
        Route::post('/transaction/increasecart/{id}', 'TransactionController@increasecart');
        Route::post('/transaction/decreasecart/{id}', 'TransactionController@decreasecart');
        Route::post('/transaction/bayar','TransactionController@bayar');
        Route::get('/transaction/history','TransactionController@history');
        Route::get('/transaction/laporan/{id}','TransactionController@laporan');
        Route::resource('transaction', 'TransactionController');        
    });

    // Kategori
    Route::group(['middleware' => ['permission:manajemen kategori']], function() {         
        Route::resource('category', 'CategoryController');         
    });
    
    //profile
    Route::resource('/profile', 'ProfileController');

    Route::get('/home', 'HomeController@index')->name('home');
});

