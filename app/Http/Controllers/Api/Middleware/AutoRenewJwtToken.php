<?php

namespace Yeelight\Http\Controllers\Api\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

/**
 * Class AutoRenewJwtToken
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Middleware
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AutoRenewJwtToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Closure $next Closure
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // verify only if token present
        if ($token = $this->auth->setRequest($request)->getToken()) {
            // valid for refresh
            if (is_jwt_token_valid_for_refresh($token)) {
                $newToken = refresh_jwt_token();
                if (!empty($newToken)) {
                    // send the refreshed token back to the client
                    $response->headers->set('Authorization', $newToken);
                }
            }
        }

        return $response;
    }
}
