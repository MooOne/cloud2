<?php

namespace Yeelight\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class BackendServiceProvider
 *
 * @category Yeelight
 *
 * @package Yeelight\Providers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class BackendServiceProvider extends ServiceProvider
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'backend.auth'       => \Yeelight\Http\Middleware\Authenticate::class,
        'backend.pjax'       => \Yeelight\Http\Middleware\Pjax::class,
        'backend.log'        => \Yeelight\Http\Middleware\LogOperation::class,
        'backend.permission' => \Yeelight\Http\Middleware\Permission::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'backend' => [
            'backend.auth',
            'backend.pjax',
            'backend.log',
        ],
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadBackendAuthConfig();

        $this->registerRouteMiddleware();
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadBackendAuthConfig()
    {
        config(array_dot(config('yeelight.backend.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
