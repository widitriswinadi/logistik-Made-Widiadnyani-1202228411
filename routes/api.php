<?php

use App\Http\Controllers\api\TrackingController;
use App\Http\Controllers\api\PengirimanBarangController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tracking', TrackingController::class);
Route::apiResource('pengiriman', PengirimanBarangController::class);
// Route::apiResource('login', UserController::class);
Route::post('/login',[UserController::class,'login']);

