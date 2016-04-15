<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/products', function () {
    return view('products');
});
Route::get('/customers', function () {
    return view('customers');
});

Route::get('/api/v1/customers/{id?}', 'Customers@index');
Route::post('/api/v1/customers', 'Customers@store');
Route::post('/api/v1/customers/{id}', 'Customers@update');
Route::delete('/api/v1/customers/{id}', 'Customers@destroy');

Route::get('/api/v1/products/{id?}', 'Products@index');
Route::post('/api/v1/products', 'Products@store');
Route::post('/api/v1/products/{id}', 'Products@update');
Route::delete('/api/v1/products/{id}', 'Products@destroy');