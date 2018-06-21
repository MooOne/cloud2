<?php

use Dingo\Api\Routing\Router;

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

// v1
$api->version('v1', [
    'namespace'  => 'Yeelight\Http\Controllers\Api\Controllers',
    'middleware' => ['api'],
], function (Router $api) {
    // 登录前操作
    $api->group(['middleware' => ['api.throttle'], 'prefix' => 'auth', 'limit' => 100, 'expires' => 5], function (Router $api) {
        $api->post('register', 'AuthController@register');
        $api->post('login', 'AuthController@login');
        $api->post('refresh', 'AuthController@refresh');
        $api->post('socialite_auth', 'SocialiteUsersController@socialAuth')->middleware('socialite.auto_password');
    });

    $api->group(['middleware' => ['auth:api']], function (Router $api) {

        // Rate: 100 requests per 5 minutes
        $api->group(['middleware' => ['api.throttle'], 'limit' => 100, 'expires' => 5], function (Router $api) {
            // logout
            $api->post('auth/logout', 'AuthController@logout');

            // 用户模块
            $api->group(['prefix' => 'users'], function (Router $api) {
                $api->get('/me', 'UsersController@me');
                $api->put('/me', 'UsersController@update');
                //$api->delete('/me', 'UsersController@destroy');
            });

            // 产品模型模块
            $api->resource('product_models', 'ProductModelsController');
        });
    });
});
