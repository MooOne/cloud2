<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yeelight\Base\Api\Controllers\Controller;
use Yeelight\Models\Foundation\User;

/**
 * Class BaseController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Controllers
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
     * GetAuthUser
     *
     * @return User
     */
    public function getAuthUser()
    {
        $authUser = auth_user();
        if ($authUser->status == 0) {
            return $this->response->errorForbidden('User Are Forbidden');
        }

        return auth_user();
    }

    /**
     * 代理请求 oauth token.
     *
     * @param Request $request Request
     * @param string $grantType grantType
     * @param string $scope scope
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function issueToken(Request $request, $grantType = 'password', $scope = '')
    {
        $params = [
            'grant_type'    => $grantType,
            'client_id'     => $request->client_id,
            'client_secret' => $request->client_secret,
            'username'      => $request->username,
            'password'      => $request->password,
            'scope'         => $scope,
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }
}
