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

Route::get( '/', 'HomeController@index' );


// Auth Routes
Route::group(['prefix' => config('yeelight.backend.auth_route.prefix'), 'namespace' => config('yeelight.backend.auth_route.namespace')], function ($router) {
    // Authentication Routes...
    $router->get('login', 'LoginController@showLoginForm')->name('backend.auth.login');
    $router->post('login', 'LoginController@login')->name('backend.auth.login.post');
    $router->any('logout', 'LoginController@logout')->name('backend.auth.logout');

    // Registration Routes...
    $router->get('register', 'RegisterController@showRegistrationForm')->name('backend.auth.register');
    $router->post('register', 'RegisterController@register')->name('backend.auth.register.post');

    // Password Reset Routes...
    $router->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('backend.auth.password.request');
    $router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('backend.auth.password.email.post');
    $router->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('backend.auth.password.reset');
    $router->post('password/reset', 'ResetPasswordController@reset')->name('backend.auth.reset.post');



});


// Backend Routes
Route::group([
    'prefix'        => config('yeelight.backend.route.prefix'),
    'namespace'     => config('yeelight.backend.route.namespace'),
    'middleware'    => config('yeelight.backend.route.middleware'),
], function ($router) {

    $router->get('/','HomeController@index');

    //$router->get('auth/setting', 'AuthController@getSetting');
    //$router->put('auth/setting', 'AuthController@putSetting');

    $router->resource('auth/users', 'AdminUsersController');
    $router->resource('auth/roles', 'AdminRolesController');
    $router->resource('auth/permissions', 'AdminPermissionsController');
    $router->resource('auth/menus', 'AdminMenusController', ['except' => ['create']]);
    $router->post('auth/menus/order', 'AdminMenusController@order')->name('menus.order');
    $router->resource('auth/logs', 'AdminOperationLogsController', ['only' => ['index', 'destroy']]);



    // 权限
    //require(__DIR__ . '/console/permission.php');
    
    $router->resource( 'firmware/gingko', GingkoController::class );


    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


});




// Mobile Routes
Route::group([
    'prefix' => config('yeelight.mobile.route.prefix'),
    'namespace' => config('yeelight.mobile.route.namespace')
], function () {

    // Mobile App
    Route::get('/', 'MobileController@getIndex');

    Route::get('/app', 'MobileController@getApp');

    // Protected Routes
    Route::group(['middleware' => 'auth'], function () {

        Route::get('users', 'UserController@getUserList');

        Route::get('users/{id}', 'UserController@getUserDetail');

    });

});


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