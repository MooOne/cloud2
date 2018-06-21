<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-20
 * Time: 下午4:11.
 */
//Tools
Route::group([
    'prefix'        => 'tools',
], function ($router) {
    //日志查看器
    $router->get('logs', 'Tools\LogViewer\LogController@index')->name('tools.log-viewer-index');
    $router->get('logs/{file}', 'Tools\LogViewer\LogController@index')->name('tools.log-viewer-file');
    $router->get('logs/{file}/tail', 'Tools\LogViewer\LogController@tail')->name('tools.log-viewer-tail');

    //计划任务
    $router->get('scheduling', 'Tools\Scheduling\SchedulingController@index')->name('tools.scheduling-index');
    $router->post('scheduling/run', 'Tools\Scheduling\SchedulingController@runEvent')->name('tools.scheduling-run');

    //数据库终端
    $router->get('terminal/database', 'Tools\Terminal\TerminalController@database')->name('tools.terminal-database');
    $router->post('terminal/database', 'Tools\Terminal\TerminalController@runDatabase')->name('tools.terminal-run-database');

    //Aritsan终端
    $router->get('terminal/artisan', 'Tools\Terminal\TerminalController@artisan')->name('tools.terminal-artisan');
    $router->post('terminal/artisan', 'Tools\Terminal\TerminalController@runArtisan')->name('tools.terminal-run-artisan');

    //脚手架
    $router->get('scaffold', 'Tools\Scaffold\ScaffoldController@index')->name('tools.scaffold-index');
    $router->post('scaffold', 'Tools\Scaffold\ScaffoldController@store')->name('tools.scaffold-store');

    //路由查看器
    $router->get('routes', 'Tools\Routes\RouteController@index')->name('tools.routes-index');

    //Api tester
    $router->get('api-tester', 'Tools\ApiTester\ApiTesterController@index')->name('tools.api-tester-index');
    $router->post('api-tester/handle', 'Tools\ApiTester\ApiTesterController@handle')->name('tools.api-tester-handle');
});
