<?php
$router->group(['prefix' => 'menu'],function ($router)
{
	$router->get('orderable','MenusController@orderable')->name('menu.orderable');
});
$router->resource('menu','MenusController');