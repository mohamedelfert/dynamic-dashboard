<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Api'], function() {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function() {
        Route::group(['middleware' => ['auth:api', 'HasUserPreferencesModule', 'localization']], function() {
            Route::group(['prefix' => 'preferences'], function() {
                Route::get('my-preferences', 'UserPreferencesController@MyPreferences');
                Route::post('update-my-preference', 'UserPreferencesController@updateMyPreferences');
            });
        });
    });
});
