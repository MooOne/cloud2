<?php
$router->group(['prefix' => 'permission'],function ($router)
{
    $router->get('ajaxIndex','PermissionsController@ajaxIndex')->name('permissions.ajaxIndex');
});
$router->resource('permission','PermissionsController',['except' => ['show']]);