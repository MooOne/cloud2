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

class SchedulingController extends BaseController
{
    /**
     * 主页.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param Request $request
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
