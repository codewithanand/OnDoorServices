<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/address/district/{stateCode}', [App\Http\Controllers\Api\AddressController::class, 'getDistrict']);
Route::get('/address/city/{districtCode}', [App\Http\Controllers\Api\AddressController::class, 'getCity']);
Route::get('/address/village/{cityCode}', [App\Http\Controllers\Api\AddressController::class, 'getVillage']);

Route::get('/service/{categoryId}', [App\Http\Controllers\Api\ServiceController::class, 'getService']);

Route::get('/cities', [App\Http\Controllers\Api\CityController::class, 'getCityByName']);

Route::get('/appointments/{id}', [App\Http\Controllers\Api\CallRequestController::class, 'getCallRequestById']);
Route::get('/appointments/city/{cityCode}', [App\Http\Controllers\Api\CallRequestController::class, 'getCallRequestByCityCode']);




