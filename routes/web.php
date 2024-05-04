<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index']);

Route::get('/category/{id}', [App\Http\Controllers\Client\CategoryController::class, 'index']);
Route::get('/service/{id}', [App\Http\Controllers\Client\ServiceController::class, 'index']);

Route::get('/services', [App\Http\Controllers\Client\ServiceController::class, 'services']);
Route::get('/jobs', [App\Http\Controllers\Client\ServiceController::class, 'jobs']);

Route::get('/service/request/call', [App\Http\Controllers\Client\CallRequestController::class, 'index']);
Route::post('/service/request/call', [App\Http\Controllers\Client\CallRequestController::class, 'store']);



// USER ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/seeker/register', [App\Http\Controllers\Client\SeekerController::class, 'register']);
    Route::post('/seeker/register', [App\Http\Controllers\Client\SeekerController::class, 'store']);


    Route::get('/profile', [App\Http\Controllers\Client\UserController::class, 'index']);
    
    Route::get('/job/apply/{id}', [App\Http\Controllers\Client\JobRequestController::class, 'index']);
});

// PARTNER ROUTES
Route::prefix("partner")->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Partner\PartnerController::class, 'index']);

    Route::get('/register', [App\Http\Controllers\Partner\ServicePartnerController::class, 'index']);
    Route::post('/register', [App\Http\Controllers\Partner\ServicePartnerController::class, 'store']);
    
    Route::get('/services/add', [App\Http\Controllers\Partner\ServiceController::class, 'index']);
    Route::post('/{id}/services/add', [App\Http\Controllers\Partner\ServiceController::class, 'store']);

    Route::get('/service/{id}/delete', [App\Http\Controllers\Partner\ServiceController::class, 'destroy']);
    Route::get('/service/{id}/delete', [App\Http\Controllers\Partner\ServiceController::class, 'destroy']);

    Route::get('/service/request/check/{id}', [App\Http\Controllers\Partner\ServiceRequestController::class, 'update']);
});


// ADMIN ROUTES
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::post('/category/{id}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('/category/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('/service', [App\Http\Controllers\Admin\ServiceController::class, 'index']);
    Route::post('/service/store', [App\Http\Controllers\Admin\ServiceController::class, 'store']);

});
