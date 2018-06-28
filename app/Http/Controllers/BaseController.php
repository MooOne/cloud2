<?php

namespace Yeelight\Http\Controllers;

use Yeelight\Base\Http\Controllers\Controller;
use Yeelight\Models\Foundation\User;

/**
 * Class BaseController
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
abstract class BaseController extends Controller
{
    /**
     * @return User
     */
    public function getAuthUser()
    {
        return backend_user();
    }

    /**
     * @return mixed|null
     */
    public function getAuthUserId()
    {
        return $this->getAuthUser()->id;
    }
}
