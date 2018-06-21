<?php

namespace Yeelight\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Yeelight\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Yeelight\Http\Middleware\TrustProxies::class,
        \Clockwork\Support\Laravel\ClockworkMiddleware::class,
        \Yeelight\Http\Middleware\EnableCrossRequest::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Yeelight\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Yeelight\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
            \Yeelight\Services\Locale\Middleware\LocaleMiddleware::class,
        ],

        'api' => [
//            'throttle:60,1',
            'bindings',
            \Yeelight\Http\Controllers\Api\Middleware\ApiAccessMiddleware::class,
            \Yeelight\Services\Locale\Middleware\LocaleMiddleware::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'      => \Yeelight\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'client'     => CheckClientCredentials::class,

        // Passport
        'scopes' => \Laravel\Passport\Http\Middleware\CheckScopes::class,
        'scope'  => \Laravel\Passport\Http\Middleware\CheckForAnyScope::class,

        // Socialite
        'socialite.auto_password' => \Yeelight\Http\Middleware\SocialiteAutoPassword::class,
    ];
}
