<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;
use Yeelight\Models\Foundation\User;
use Yeelight\Models\SocialiteUser;
use Yeelight\Repositories\Criteria\GetUserByUsernameOrEmailCriteria;
use Yeelight\Repositories\Criteria\SocialiteAuthUserCriteria;
use Yeelight\Repositories\Interfaces\SocialiteUserRepository;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\SocialiteUserValidator;

/**
 * Class SocialiteUsersController
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
class SocialiteUsersController extends BaseController
{
    /**
     * SocialiteUserRepository
     *
     * @var SocialiteUserRepository
     */
    protected $repository;

    /**
     * SocialiteUserValidator
     *
     * @var SocialiteUserValidator
     */
    protected $validator;

    /**
     * UserRepository
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * SocialiteUsersController constructor.
     *
     * @param SocialiteUserRepository $repository SocialiteUserRepository
     * @param SocialiteUserValidator $validator SocialiteUserValidator
     * @param UserRepository $userRepository UserRepository
     */
    public function __construct(
        SocialiteUserRepository $repository,
        SocialiteUserValidator $validator,
        UserRepository $userRepository
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }

    /**
     * 第三方登录.
     *
     * @param SocialiteAuthRequest $request SocialiteAuthRequest
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function socialAuth(SocialiteAuthRequest $request)
    {

        // 默认信任客户端的第三方认证
        // 为保险起见，也可以使用客户端获取到的AccessToken再去第三方验证
        // TODO 使用客户端获取到的AccessToken去第三方验证

        $socialiteAuthUser = $this->repository->pushCriteria(
            new SocialiteAuthUserCriteria($request)
        )->skipPresenter()->first();

        if (!empty($socialiteAuthUser)) {
            // 更新第三方账号信息
            $this->updateSocialiteUser($request, $socialiteAuthUser);

            return $this->issueToken($request);
        }

        $authUser = $this->userRepository->pushCriteria(
            new GetUserByUsernameOrEmailCriteria($request)
        )->skipPresenter()->first();

        if (!empty($authUser)) {
            // 用户状态是否为禁止
            if ($authUser->status == 0) {
                return $this->response->errorForbidden('User Are Forbidden');
            }
            // 添加第三方账号和user的关联
            $this->addSocialiteUser($request, $authUser);
        } else {
            // 根据第三方信息创建新用户
            $this->createUser($request);
        }

        return $this->issueToken($request);
    }

    /**
     * 添加第三方账号和user的关联.
     *
     * @param SocialiteAuthRequest $request SocialiteAuthRequest
     * @param User $user User
     *
     * @return void
     */
    private function addSocialiteUser(SocialiteAuthRequest $request, User $user)
    {
        $data = $request->all();

        // 验证 provider + provider_user_id 唯一性
        $this->validate(
            $request,
            [
                'provider' => [
                    'required',
                    Rule::unique('socialite_users')->where(function ($query) use ($user) {
                        return $query->where('user_id', $user->user_id);
                    }),
                ],
                'provider_user_id' => 'required',
            ]
        );

        $data['user_id'] = $user->user_id;
        $this->repository->create($data);
    }

    /**
     * 更新第三方账号信息.
     *
     * @param SocialiteAuthRequest $request SocialiteAuthRequest
     * @param SocialiteUser $socialiteUser SocialiteUser
     *
     * @return void
     */
    private function updateSocialiteUser(SocialiteAuthRequest $request, SocialiteUser $socialiteUser)
    {
        $data = $request->all();
        $data['user_id'] = $socialiteUser->user_id;
        $this->repository->update($data, $socialiteUser->id);
    }

    /**
     * 创建用户和对应的第三方账号并关联.
     *
     * @param SocialiteAuthRequest $request SocialiteAuthRequest
     *
     * @throws \Throwable
     *
     * @return void
     */
    private function createUser(SocialiteAuthRequest $request)
    {
        $data = $request->all();

        DB::transaction(function () use ($request, $data) {
            $user = $this->userRepository->create($data);
            $this->addSocialiteUser($request, $user);
        });
    }
}
