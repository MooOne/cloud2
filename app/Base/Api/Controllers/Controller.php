<?php
namespace Yeelight\Base\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Yeelight\Api\Foundation\Validation\ValidatesRequests;
use Yeelight\Auth\AuthUserHelpers;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use AuthUserHelpers;
    use Helpers;

}