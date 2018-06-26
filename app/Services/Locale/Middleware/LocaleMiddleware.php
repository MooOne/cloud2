<?php

namespace Yeelight\Services\Locale\Middleware;

use Carbon\Carbon;
use Closure;
use LaravelLocalization;

/**
 * Class LocaleMiddleware
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Locale\Middleware
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class LocaleMiddleware
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

        // get supported locales
        $supportedLocales = LaravelLocalization::getSupportedLocales();

        // 1. get current locale
        $locale = LaravelLocalization::getCurrentLocale();

        // 2. check from session
        $sessionLocale = session('yeelight-locale');
        if (!empty($sessionLocale)) {
            // if supported
            if (is_array($supportedLocales) && isset($supportedLocales[$sessionLocale])) {
                $locale = $sessionLocale;
            }
        }

        // 3. check from lang
        $lang = $request->get('lang');
        if (!empty($lang)) {
            // if supported
            if (is_array($supportedLocales) && isset($supportedLocales[$lang])) {
                $locale = $lang;
            }
        }

        // set locale
        LaravelLocalization::setLocale($locale);

        // set carbon locale
        Carbon::setLocale($locale);

        return $next($request);
    }
}
