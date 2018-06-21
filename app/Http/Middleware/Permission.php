<?php

namespace Yeelight\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yeelight\Models\Permission as Checker;

class Permission
{
    /**
     * @var string
     */
    protected $middlewarePrefix = 'yeelight.backend.permission:';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param array                    $args
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, ...$args)
    {
        if (!Auth::guard(config('yeelight.backend.route.prefix'))->user() || !empty($args)) {
            return $next($request);
        }

        if ($this->checkRoutePermission($request)) {
            return $next($request);
        }

        if (!Auth::guard(config('yeelight.backend.route.prefix'))->user()->allPermissions()->first(function ($permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            Checker::error();
        }

        return $next($request);
    }

    /**
     * If the route of current request contains a middleware prefixed with 'admin.permission:',
     * then it has a manually set permission middleware, we need to handle it first.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkRoutePermission(Request $request)
    {
        if (!$middleware = collect($request->route()->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(Checker::class, $method)) {
            throw new \InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func_array([Checker::class, $method], [$args]);

        return true;
    }
}
