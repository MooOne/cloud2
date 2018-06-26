<?php

namespace Yeelight\Base\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Yeelight\Http\Controllers\Api\Foundation\Validation\ValidatesRequests;
use Yeelight\Traits\AuthUserHelpers;

/**
 * Class Controller
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Api\Controllers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use AuthUserHelpers;
    use Helpers;
}
