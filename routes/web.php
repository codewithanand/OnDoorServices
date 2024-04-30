<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/partner/dashboard', [App\Http\Controllers\Client\PartnerController::class, 'index']);

    Route::get('/register/partner', [App\Http\Controllers\Client\ServicePartnerController::class, 'index']);
    Route::post('/register/partner', [App\Http\Controllers\Client\ServicePartnerController::class, 'store']);
    
    Route::get('/partner/services/add', [App\Http\Controllers\Client\ServiceController::class, 'index']);
    Route::post('/partner/{id}/services/add', [App\Http\Controllers\Client\ServiceController::class, 'store']);

    Route::get('/partner/service/{id}/delete', [App\Http\Controllers\Client\ServiceController::class, 'destroy']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\Client\UserController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::post('/admin/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::post('/admin/category/{id}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('/admin/category/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

});
