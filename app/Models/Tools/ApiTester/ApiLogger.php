<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-19
 * Time: 上午9:39.
 */

namespace Yeelight\Models\Tools\ApiTester;

use Illuminate\Support\Facades\File;

/**
 * Class ApiLogger
 *
 * @category Yeelight
 *
 * @package Yeelight\Models\Tools\ApiTester
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ApiLogger
{
    protected static $path = 'api-tester/api-tester.json';

    public static function log($method, $uri, $parameters = [], $user = null)
    {
        $parameters = get_defined_vars();
        $logPath = storage_path(static::$path);
        if (!file_exists($logPath)) {
            File::makeDirectory(dirname($logPath));
        }
        File::append($logPath, json_encode($parameters).',');
    }

    public static function load()
    {
        $logPath = storage_path(static::$path);
        $data = File::get($logPath);
        $json = '['.trim($data, ',').']';
        $history = array_reverse(json_decode($json, true));
        foreach ($history as &$item) {
            $item['parameters'] = static::formatParameters($item['parameters']);
        }

        return $history;
    }

    public static function formatParameters($parameters = [])
    {
        if (empty($parameters)) {
            return '[]';
        }
        $retval = [];
        foreach ($parameters as $name => $value) {
            $retval[] = [
                'name'         => $name,
                'defaultValue' => $value,
            ];
        }

        return json_encode($retval);
    }
}
