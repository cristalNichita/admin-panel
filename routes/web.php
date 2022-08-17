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

Route::prefix('admin')->name('admin.')->group(function() {
    Auth::routes();

    Route::middleware('auth')->group(function() {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');

        Route::resources([
            'categories' => App\Http\Controllers\CategoryController::class,
            'products' => App\Http\Controllers\ProductController::class,
            'users' => App\Http\Controllers\UserController::class,
        ]);
    });
});
