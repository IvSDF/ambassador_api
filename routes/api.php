<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum', 'scope.admin'])->group(function (){
        Route::get('user', [AuthController::class, 'user'])->name('user');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::put('user/info', [AuthController::class, 'updateInfo'])->name('updateInfo');
        Route::put('user/password', [AuthController::class, 'updatePassword'])->name('updatePassword');

        Route::get('ambassadors', [AmbassadorController::class, 'index']);
        Route::get('users/{id}/links', [LinkController::class, 'index']);
        Route::get('orders', [OrderController::class, 'index']);

        Route::apiResource('products',ProductController::class);

    });
});
