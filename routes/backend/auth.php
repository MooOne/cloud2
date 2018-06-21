<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-20
 * Time: 下午4:20.
 */
Route::group([
    'prefix'    => config('yeelight.backend.auth_route.prefix'),
    'namespace' => config('yeelight.backend.auth_route.namespace'),
], function ($router) {
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
