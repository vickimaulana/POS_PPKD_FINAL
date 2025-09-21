<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/action-login', [LoginController::class, 'actionLogin']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'role:1'], function () {
        Route::resource('users', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
    });

    Route::group(['middleware' => 'role:2,1'], function () {
        Route::get('/report', [TransactionController::class, 'report'])->name('report');
        Route::get('/report/{id}', [TransactionController::class, 'reportDetail'])->name('reportDetail');
        Route::get('/report/print', [TransactionController::class, 'print'])->name('report.print');


    });

    Route::group(['middleware' => 'role:3'], function () {
        Route::get('/kasir', [TransactionController::class, 'kasir'])->name('kasir');
        Route::post('/kasir', [TransactionController::class, 'kasirPost'])->name('kasir.post');
    });

    Route::group(['middleware' => 'role:2,3'], function () {
        Route::get('/stock', [ProductController::class, 'stock'])->name('stock');
    });
});
