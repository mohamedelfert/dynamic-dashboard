<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Modules\DynamicDashboard\App\Http\Controllers\Api\V1\DynamicDashboardController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('v1')->name('api.')->group(function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('widgets', [DynamicDashboardController::class, 'getWidgets'])->name('widgets');
        Route::get('templates', [DynamicDashboardController::class, 'getTemplates'])->name('templates');
        Route::get('/user-widgets/{id}', [DynamicDashboardController::class, 'index'])->name('index');
        Route::post('store-widgets', [DynamicDashboardController::class, 'store'])->name('storeWidgets');
        Route::post('store-template', [DynamicDashboardController::class, 'storeTemplate'])->name('storeTemplate');
        Route::post('update-user-widgets', [DynamicDashboardController::class, 'updateUserWidgets'])->name('updateUserWidgets');
    });
});
