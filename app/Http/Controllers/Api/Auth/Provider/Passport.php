<?php

namespace Yeelight\Http\Controllers\Api\Auth\Provider;

use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class Passport
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Auth\Provider
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class Passport extends Authorization
{
    /**
     * Illuminate authentication manager.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The guard driver name.
     *
     * @var string
     */
    protected $guard = 'api';

    /**
     * Create a new basic provider instance.
     *
     * @param \Illuminate\Auth\AuthManager $auth AuthManager
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth->guard($this->guard);
    }

    /**
     * Authenticate request with a Illuminate Guard.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Dingo\Api\Routing\Route $route Route
     *
     * @return mixed
     */
    public function authenticate(Request $request, Route $route)
    {
        if (!$user = $this->auth->user()) {
            throw new UnauthorizedHttpException(null, 'Unauthenticated.');
        }

        return $user;
    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return 'Bearer';
    }
}
