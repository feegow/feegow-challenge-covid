<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ->middleware('auth:sanctum');