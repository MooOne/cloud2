<?php

namespace Yeelight\Services\Locale\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yeelight\Base\Http\Controllers\Controller;

/**
 * Class LocaleController
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Locale\Controllers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class LocaleController extends Controller
{
    /**
     * @param Request $request
     * @param $locale
     *
     * @return \Illuminate\Http\Response
     */
    public function getLocaleJs(Request $request, $locale)
    {
        $content = 'window.Yeelight.locales = '.json_encode(trans('app', [], $locale));
        $response = response()->make($content);
        $response->header('Content-Type', 'application/javascript');
        $response->setPublic()
            ->setMaxAge(604800)
            ->setExpires(Carbon::now()->addDay(7));

        return $response;
    }

    /**
     * @param Request $request
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getSwitchLocale(Request $request, $locale)
    {
        // check if supported
        $supportedLanguagesKeys = \LaravelLocalization::getSupportedLanguagesKeys();
        if (!in_array($locale, $supportedLanguagesKeys)) {
            abort(404);
        }

        // store in session
        session(['yeelight-locale' => $locale]);

        // check if has redirect url
        $redirect_url = '/';
        if ($request->has('redirect_url')) {
            $redirect_url = $request->get('redirect_url');
        }

        return redirect($redirect_url);
    }
}
