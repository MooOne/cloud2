<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yeelight\Http\Requests\Api\AuthLoginRequest;
use Yeelight\Http\Requests\Api\AuthRefreshRequest;
use Yeelight\Http\Requests\Api\AuthRegisterRequest;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\UserValidator;

class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * 登录.
     *
     * @param AuthLoginRequest $request
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
     * @param AuthRefreshRequest $request
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
     * @param Request $request
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
     * @param AuthRegisterRequest $request
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
