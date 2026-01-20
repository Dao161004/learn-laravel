<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/index', function () {
    return view('index');
}) -> name('index');

Route::get('/about', function () {
    return response() -> json ('about page');
});

//Sinh vien routes
Route::get('/sinhvien/{name?}/{mssv?}', function (string $name = 'Nguyen Van Dao', string $mssv = '0003967') {
    return view('sinhvien.info', ['name' => $name, 'mssv' => $mssv]);
}) -> name('sinhvien.info');

Route::get('/banco/{n}', function (int $n) {
    return view('banco', ['n' => $n]);
}) -> name('banco');

//Product routes
Route::prefix('product')->group(function () {
    Route::get('/', function () {
    return view('product.index');
    });

    Route::get('/add', function () {
        return view('product.add');
    }) -> name('product.add');

    Route::get('/{id?}', function (string $id = '123') {
        return view('product.detail', ['id' => $id]);
    }) -> name('product.detail');
});

Route::fallback(function () {
    return response() -> view('error.404');
});