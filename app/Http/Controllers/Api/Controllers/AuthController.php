<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yeelight\Http\Requests\Api\AuthLoginRequest;
use Yeelight\Http\Requests\Api\AuthRefreshRequest;
use Yeelight\Http\Requests\Api\AuthRegisterRequest;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\UserValidator;

/**
 * Class AuthController
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
class AuthController extends BaseController
{
    /**
     * UserRepository
     *
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserValidator
     *
     * @var UserValidator
     */
    protected $validator;

    /**
     * AuthController constructor.
     *
     * @param UserRepository $repository UserRepository
     * @param UserValidator $validator UserValidator
     */
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * 登录.
     *
     * @param AuthLoginRequest $request AuthLoginRequest
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $request)
    {
        return $this->issueToken($request, 'password');
    }

    /**
     * 刷新 token.
     *
     * @param AuthRefreshRequest $request AuthRefreshRequest
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function refresh(AuthRefreshRequest $request)
    {
        return $this->issueToken($request, 'refresh_token');
    }

    /**
     * 登出.
     *
     * @param Request $request Request
     *
     * @return \Dingo\Api\Http\Response
     */
    public function logout(Request $request)
    {
        $accessToken = $this->getAuthUser()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);
        $accessToken->revoke();

        // Had logout, return 204 No Content
        return $this->response->noContent();
    }

    /**
     * 注册.
     *
     * @param AuthRegisterRequest $request AuthRegisterRequest
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return $this->issueToken($request, 'password');
    }
}
