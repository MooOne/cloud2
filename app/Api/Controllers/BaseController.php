<?php
namespace Yeelight\Api\Controllers;

use Someline\Base\Api\Controllers\Controller;
use Yeelight\Models\Foundation\User;

abstract class BaseController extends Controller
{

    /**
     * @return User
     */
    public function getAuthUser()
    {
        return auth_user();
    }

}