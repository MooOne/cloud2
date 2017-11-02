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

Route::get('/', function () {
    return view('index');
});

/**
 * Admire Template Routes
 */
Route::group(['prefix' => 'demo'], function () {
    Route::get('/','AdmireController@index');

    Route::get('{name?}','AdmireController@showView');

    Route::get('users','AdmireController@index');

    Route::post('users','AdmireController@store');
});


// Auth Routes
Route::group(['prefix' => 'console', 'namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::any('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

// Console Routes
Route::group(['prefix' => 'console', 'middleware' => 'auth', 'namespace' => 'Console'], function ($router) {

    $router->get('/', function () {
        return view('console.index');
    });

    // 权限
    require(__DIR__ . '/console/permission.php');
    // 角色
    require(__DIR__ . '/console/role.php');
    // 用户
    require(__DIR__ . '/console/user.php');
    // 菜单
    require(__DIR__ . '/console/menu.php');

    Route::get('/menu', 'MenusController@index');
    Route::get('oauth', 'ConsoleController@getOauth');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


});

// Mobile Routes
Route::group(['prefix' => 'm', 'namespace' => 'Mobile'], function () {

    // Mobile App
    Route::get('/', 'MobileController@getIndex');

    Route::get('/app', 'MobileController@getApp');

    // Protected Routes
    Route::group(['middleware' => 'auth'], function () {

        Route::get('users', 'UserController@getUserList');

        Route::get('users/{id}', 'UserController@getUserDetail');

    });

});

// Basic Routes
//Route::get('/home', 'HomeController@index');

// Protected Routes
Route::group(['middleware' => 'auth'], function () {

//    Route::get('/', function () {
//        return redirect('users');
//    });

    //Route::get('/', 'ExampleController@getIndexExample');
    Route::get('blank-example', 'ExampleController@getBlankExample');
    Route::get('desktop-example', 'ExampleController@getDesktopExample');

    Route::get('users', 'UserController@getUserList');

});

// Image Routes
// @WARNING: The 'image' prefix is reserved for SomelineImageService
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