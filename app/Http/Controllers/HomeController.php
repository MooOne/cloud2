<?php

namespace Yeelight\Http\Controllers;

/**
 * Class HomeController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(config('yeelight.backend.route.prefix'));
    }
}
