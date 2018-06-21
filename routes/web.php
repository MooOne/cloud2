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

Route::get('/', 'HomeController@index');

// Auth Routes
require __DIR__.'/backend/auth.php';

// Backend Routes
require __DIR__.'/backend/web.php';

// Image Routes
// @WARNING: The 'image' prefix is reserved for YeelightImageService
Route::group(['prefix' => 'image'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/', 'ImageController@postImage');
    });

    Route::get('{type}/{name}', 'ImageController@showTypeImage');
    Route::get('/{name}', 'ImageController@showOriginalImage');
});

// Locale Routes
// @WARNING: The 'locales' prefix is reserved for YeelightLocaleController
Route::group(['prefix' => 'locales'], function () {
    Route::get('/{locale}.js', '\Yeelight\Services\Locale\Controllers\LocaleController@getLocaleJs');

    Route::get('/switch/{locale}', '\Yeelight\Services\Locale\Controllers\LocaleController@getSwitchLocale');
});
