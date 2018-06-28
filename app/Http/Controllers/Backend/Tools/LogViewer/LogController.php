<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-18
 * Time: 下午5:02.
 */

namespace Yeelight\Http\Controllers\Backend\Tools\LogViewer;

use Illuminate\Http\Request;
use Yeelight\Http\Controllers\BaseController;
use Yeelight\Models\Tools\LogViewer\LogViewer;

/**
 * Class LogController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend\Tools\LogViewer
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class LogController extends BaseController
{
    /**
     * 主页.
     *
     * @param $file
     * @param Request $request Request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function index(Request $request, $file = null)
    {
        $offset = $request->get('offset');

        $viewer = new LogViewer($file);

        return view(
            'backend.tools.log_viewer.logs',
            [
                'logs' => $viewer->fetch($offset),
                'logFiles' => $viewer->getLogFiles(),
                'fileName' => $viewer->file,
                'end' => $viewer->getFilesize(),
                'tailPath' => route('tools.log-viewer-tail', ['file' => $viewer->file]),
                'prevUrl' => $viewer->getPrevPageUrl(),
                'nextUrl' => $viewer->getNextPageUrl(),
                'filePath' => $viewer->getFilePath(),
                'size' => static::bytesToHuman($viewer->getFilesize()),
                'levelColors' => LogViewer::$levelColors,
            ]
        );
    }

    /**
     * Tail
     *
     * @param $file
     * @param Request $request Request
     *
     * @return array
     */
    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');

        $viewer = new LogViewer($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    /**
     * BytesToHuman
     *
     * @param $bytes
     *
     * @return string
     */
    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
