<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Testcontroller;
use App\Http\Middleware\CheckTimeAccess;

Route::get('/', function () {
    return view('home');
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return response()->json('about page');
});

//Sinh vien routes
Route::get('/sinhvien/{name?}/{mssv?}', function (string $name = 'Nguyen Van Dao', string $mssv = '0003967') {
    return view('sinhvien.info', ['name' => $name, 'mssv' => $mssv]);
})->name('sinhvien.info');

Route::get('/banco/{n}', function (int $n) {
    return view('banco', ['n' => $n]);
})->name('banco');

//Product routes
Route::prefix('product')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/', "index");
        Route::get('/add', "create")->name('product.add');
        Route::get('/detail/{id?}', "getdetail");
        Route::post('/store', "store");
        Route::get("editView/{id}","editView");
        Route::put("edit/{id}","edit");
    });
});

Route::resource('test', Testcontroller::class);

Route::fallback(function () {
    return response()->view('error.404');
});

//Auth routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/signin', 'signin');
        Route::post('/checkSignIn', 'checkSignIn');
        Route::get('/login', 'login')->middleware(CheckTimeAccess::class);
        Route::post('/checkLogin', 'checkLogin');
    });
    
    // Age verification routes
    Route::get('/age/verify', function () {
        return view('auth.age-verify');
    });
    Route::post('/age/check');
});
