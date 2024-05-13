<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnnouncementController;

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('announcements', AnnouncementController::class);
    Route::post('logout', [LoginController::class, 'logout']);
});
