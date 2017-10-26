<?php
namespace Yeelight\Http\Controllers\Console;

use Yeelight\Http\Controllers\BaseController;

class UserController extends BaseController
{

    public function getUserList()
    {
        return view('console.users.user_list');
    }

}