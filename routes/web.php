<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
});
Route::post('/orderCreation','App\Http\Controllers\OrderController@create')->name('createOrder');
