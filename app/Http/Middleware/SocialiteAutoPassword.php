<?php

namespace Yeelight\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class SocialiteAutoPassword
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 给账号加上provider前缀
        if (
            $request->offsetExists('username') &&
            $request->offsetExists('provider') &&
            !Str::startsWith($request->username, $request->provider.'-')
        ) {
            $request->offsetSet('username', ($request->provider.'-'.$request->username));
        }

        // 默认密码为账号的 encrypt
        if (!$request->offsetExists('password') && $request->offsetExists('username')) {
            $request->offsetSet('password', md5($request->username.config('app.key')));
        }

        return $next($request);
    }
}
