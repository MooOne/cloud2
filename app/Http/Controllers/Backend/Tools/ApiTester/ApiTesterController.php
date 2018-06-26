<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-19
 * Time: 上午9:26.
 */

namespace Yeelight\Http\Controllers\Backend\Tools\ApiTester;

use Illuminate\Http\Request;
use Yeelight\Http\Controllers\BaseController;
use Yeelight\Models\Tools\ApiTester\ApiTester;
use Yeelight\Services\Assets\Assets;

/**
 * Class ApiTesterController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend\Tools\ApiTester
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ApiTesterController extends BaseController
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tester = new ApiTester();

        Assets::js('js/prism.js');
        Assets::css('css/prism.css');

        return view(
            'backend.tools.api_tester.index',
            [
                'routes' => $tester->getRoutes(),
                //'logs'   => ApiLogger::load(),
                'methodColors' => ApiTester::$methodColors,
                'header_description' => 'Api tester',
            ]
        );
    }

    /**
     * Handler
     *
     * @param Request $request Request
     *
     * @return array
     */
    public function handle(Request $request)
    {
        $method = $request->get('method');
        $uri = $request->get('uri');
        $user = $request->get('user');
        $all = $request->all();
        $keys = array_get($all, 'key', []);
        $vals = array_get($all, 'val', []);
        ksort($keys);
        ksort($vals);
        $parameters = [];
        foreach ($keys as $index => $key) {
            $parameters[$key] = array_get($vals, $index);
        }
        $parameters = array_filter(
            $parameters,
            function ($key) {
                return $key !== '';
            },
            ARRAY_FILTER_USE_KEY
        );
        $tester = new ApiTester();
        $response = $tester->call($method, $uri, $parameters, $user);

        return [
            'status'    => true,
            'message'   => 'success',
            'data'      => $tester->parseResponse($response),
        ];
    }
}
