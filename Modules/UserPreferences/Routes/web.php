<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'namespace' => 'Web'
    ],
    function () {
        Route::group(['middleware' => ['web', 'auth']], function () {
            Route::prefix('user-preferences')->group(function () {
                Route::group(['middleware' => ['HasUserPreferencesModule']], function () {
                    Route::get('/', 'UserPreferencesController@index')->name('user_preferences.index');
                    Route::match(['GET', 'POST'], '/parents/{id}', 'UserPreferencesController@childs')->name('user_preferences.child');
                    Route::post('/{preference_id}', 'UserPreferencesController@updateMyPreferences')->name('user_preferences.update.my_preferences');

                    //Modals Routes
                    Route::group(['perfix' => 'modals'], function () {
                        Route::get('my-preferences', 'UserPreferencesController@MyPreferencesModal')->name('user_preferences.modals.my_user_preferences');
                    });

                });
            });
        });
    }
);
