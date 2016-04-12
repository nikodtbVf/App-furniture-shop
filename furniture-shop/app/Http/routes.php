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

Route::get('/api/v1/customers/{id?}', 'Customers@index');
Route::post('/api/v1/customers', 'Customers@store');
Route::post('/api/v1/customers/{id}', 'Customers@update');
Route::delete('/api/v1/customers/{id}', 'Customers@destroy');