<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/about', function () {
    return response() -> json ('index');
});


Route::prefix('/product')->group(function () {
    Route::get('/', function () {
    return view('product.index');
    });

    Route::get('/add', function () {
        return view('product.add');
    }) -> name('product.add');

    Route::get('/{id}', function ($id) {
        return view('product.detail', ['id' => $id]);
    }) -> name('product.detail');
});

Route::fallback(function () {
    return response() -> view('error.404');
});