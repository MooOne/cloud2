<?php
namespace Yeelight\Http\Controllers;

use Yeelight\Base\Http\Controllers\Controller;
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
