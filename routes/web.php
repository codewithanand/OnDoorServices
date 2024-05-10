<?php

use Illuminate\Support\Facades\Route;
Auth::routes();

Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index']);

Route::get('/category/{slug}', [App\Http\Controllers\Client\CategoryController::class, 'index']);
Route::get('/services', [App\Http\Controllers\Client\ServiceController::class, 'index']);
Route::get('/services/{category_slug}/{service_slug}', [App\Http\Controllers\Client\ServiceController::class, 'services']);

Route::get('/service/request/call', [App\Http\Controllers\Client\AppointmentController::class, 'index']);
Route::post('/service/request/call', [App\Http\Controllers\Client\AppointmentController::class, 'store']);

Route::get('/service/request/freelancer', [App\Http\Controllers\Client\AppointmentController::class, 'freelancer']);


// Freelance Routes
Route::prefix('freelancer')->middleware(['auth'])->group(function () {
    Route::get('/register', [App\Http\Controllers\Freelancer\FreelancerController::class, 'register']);
    Route::post('/register', [App\Http\Controllers\Freelancer\FreelancerController::class, 'store']);
    Route::get('/dashboard', [App\Http\Controllers\Freelancer\FreelancerController::class, 'index']);
    Route::get('/appointment/{appointmentId}/book', [App\Http\Controllers\Freelancer\BookedAppointmentController::class, 'store']);
    Route::get('/booking/{bookingId}/complete', [App\Http\Controllers\Freelancer\BookedAppointmentController::class, 'complete']);
    Route::get('/booking/{bookingId}/revert', [App\Http\Controllers\Freelancer\BookedAppointmentController::class, 'revert']);
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
