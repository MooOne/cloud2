<?php
namespace Yeelight\Http\Controllers\Console;

use Yeelight\Http\Controllers\BaseController;

class ConsoleController extends BaseController
{

    public function getConsoleHome()
    {
        return view('console.index');
    }

    public function getOauth()
    {
        return view('console.oauth');
    }

}