<?php
namespace Yeelight\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yeelight\Base\Api\Controllers\Controller;
use Yeelight\Models\Foundation\User;

abstract class BaseController extends Controller
{

    /**
     * @return User
     */
    public function getAuthUser()
    {
        $auth_user = auth_user();
        if ($auth_user->status == 0) {
            return $this->response->errorForbidden('User Are Forbidden');
        }
        return auth_user();
    }

    /**
     * 代理请求 oauth token
     * @param Request $request
     * @param $grantType
     * @param string $scope
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function issueToken(Request $request, $grantType = 'password', $scope = "")
    {
        $params = [
            'grant_type' => $grantType,
            'client_id' => $request->client_id,
            'client_secret' => $request->client_secret,
            'username' => $request->username,
            'password' => $request->password,
            'scope' => $scope
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }

}