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

Route::get('/admin/dashboard', [
    'as' => 'admin.dashboard',
    'uses' => 'HomeController@dashboard'
]);

Route::get('/products', [
    'as' => 'all.products',
    'uses' => 'ProductController@index'
]);

Route::get('/create/product', [
    'as' => 'create.product',
    'uses' => 'ProductController@createProduct'
]);

Route::post('/fetch/product', [
    'as' => 'fetch.single.product',
    'uses' => 'SaleController@singleProduct'
]);

Route::post('/store-category', [
    'as' => 'store.category',
    'uses' => 'ProductController@storeCategory'
]);

Route::post('/store-company', [
    'as' => 'store.company',
    'uses' => 'ProductController@storeCompany'
]);

Route::post('/store-product', [
    'as' => 'store.product',
    'uses' => 'ProductController@storeProduct'
]);

Route::get('/fetch/products', [
    'as' => 'fetch.products',
    'uses' => 'ProductController@index'
]);

Route::get('/sales-list', [
    'as' => 'all.sales',
    'uses' => 'SaleController@index'
]);

Route::get('/add/new-sales', [
    'as' => 'create.sales',
    'uses' => 'SaleController@createSales'
]);

Route::post('/store/sales', [
    'as' => 'store.sales',
    'uses' => 'SaleController@storeSale'
]);
