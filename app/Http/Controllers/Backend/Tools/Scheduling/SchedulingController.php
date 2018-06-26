<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-18
 * Time: 下午5:45.
 */

namespace Yeelight\Http\Controllers\Backend\Tools\Scheduling;

use Illuminate\Http\Request;
use Yeelight\Http\Controllers\BaseController;
use Yeelight\Models\Tools\Scheduling\Scheduling;

/**
 * Class SchedulingController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend\Tools\Scheduling
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class SchedulingController extends BaseController
{
    /**
     * 主页.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $scheduling = new Scheduling();

        return view('backend.tools.scheduling.index', [
            'header_description' => '计划任务',
            'events'             => $scheduling->getTasks(),
        ]);
    }

    /**
     * RunEvent
     *
     * @param Request $request Request
     *
     * @return array
     */
    public function runEvent(Request $request)
    {
        $scheduling = new Scheduling();

        try {
            $output = $scheduling->runTask($request->get('id'));

            return [
                'status'    => true,
                'message'   => 'success',
                'data'      => $output,
            ];
        } catch (\Exception $e) {
            return [
                'status'    => false,
                'message'   => 'failed',
                'data'      => $e->getMessage(),
            ];
        }
    }
}
