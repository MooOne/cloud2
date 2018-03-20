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

    /**
     * datatable国际化
     * @author Sheldon
     * @date   2017-04-29
     * @return [type]     [description]
     */
    public function dataTableI18n()
    {
        return response()->json(trans('pagination.i18n'));
    }
}