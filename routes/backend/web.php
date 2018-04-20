<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-20
 * Time: 下午4:17
 */

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

    //Tools
    require(__DIR__ . '/tools.php');
});
