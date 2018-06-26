<?php

namespace Yeelight\Http\Controllers\Backend;

/**
 * Class HomeController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // environment
        $envs = [
            ['name' => 'PHP version',       'value' => 'PHP/'.PHP_VERSION],
            ['name' => 'Laravel version',   'value' => app()->version()],
            ['name' => 'CGI',               'value' => php_sapi_name()],
            ['name' => 'Uname',             'value' => php_uname()],
            ['name' => 'Server',            'value' => array_get($_SERVER, 'SERVER_SOFTWARE')],

            ['name' => 'Cache driver',      'value' => config('cache.default')],
            ['name' => 'Session driver',    'value' => config('session.driver')],
            ['name' => 'Queue driver',      'value' => config('queue.default')],

            ['name' => 'Timezone',          'value' => config('app.timezone')],
            ['name' => 'Locale',            'value' => config('app.locale')],
            ['name' => 'Env',               'value' => config('app.env')],
            ['name' => 'URL',               'value' => config('app.url')],
        ];

        // tools
        $tools = [
            'log-viewer' => [
                'name' => '日志查看器',
                'link' => route('tools.log-viewer-index'),
                'icon' => 'fa-bug',
            ],
            'scheduling' => [
                'name' => '计划任务',
                'link' => route('tools.scheduling-index'),
                'icon' => 'fa-clock-o',
            ],
            'terminal_database' => [
                'name' => '数据库终端',
                'link' => route('tools.terminal-database'),
                'icon' => 'fa-database',
            ],
            'terminal_artisan' => [
                'name' => 'Aritsan终端',
                'link' => route('tools.terminal-artisan'),
                'icon' => 'fa-terminal',
            ],
            'scaffold' => [
                'name' => '脚手架',
                'link' => route('tools.scaffold-index'),
                'icon' => 'fa-keyboard-o',
            ],
            'routes' => [
                'name' => '路由查看器',
                'link' => route('tools.routes-index'),
                'icon' => 'fa-list-alt',
            ],
            'api-tester' => [
                'name' => 'Api tester',
                'link' => route('tools.api-tester-index'),
                'icon' => 'fa-sliders',
            ],
        ];

        foreach ($tools as &$tool) {
            $name = explode('/', $tool['name']);
            $tool['installed'] = true;
        }

        // dependencies
        $json = file_get_contents(base_path('composer.json'));

        $dependencies = json_decode($json, true)['require'];

        return view('backend.home', compact('envs', 'tools', 'dependencies'));
    }
}
