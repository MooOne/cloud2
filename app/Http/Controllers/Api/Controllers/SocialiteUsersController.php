<?php
namespace Yeelight\Http\Controllers\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;
use Yeelight\Http\Requests\Api\SocialiteUserCreateRequest;
use Yeelight\Http\Requests\Api\SocialiteUserUpdateRequest;
use Yeelight\Models\Foundation\User;
use Yeelight\Repositories\Criteria\GetUserByUsernameOrEmailCriteria;
use Yeelight\Repositories\Criteria\SocialiteAuthUserCriteria;
use Yeelight\Repositories\Interfaces\SocialiteUserRepository;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\SocialiteUserValidator;

class SocialiteUsersController extends BaseController
{
    /**
     * @var SocialiteUserRepository
     */
    protected $repository;

    /**
     * @var SocialiteUserValidator
     */
    protected $validator;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        SocialiteUserRepository $repository,
        SocialiteUserValidator $validator,
        UserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }


    /**
     * 第三方登录
     *
     * @param SocialiteAuthRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function socialAuth(SocialiteAuthRequest $request){

        // 默认信任客户端的第三方认证
        // 为保险起见，也可以使用客户端获取到的AccessToken再去第三方验证
        // TODO 使用客户端获取到的AccessToken去第三方验证

        $socialiteAuthUser = $this->repository->pushCriteria(new SocialiteAuthUserCriteria($request))->skipPresenter()->first();

        if(!empty($socialiteAuthUser)){
            return $this->issueToken($request);
        }

        $authUser = $this->userRepository->pushCriteria(new GetUserByUsernameOrEmailCriteria($request))->skipPresenter()->first();

        if(!empty($authUser)){
            // 添加第三方账号和user的关联
            $this->addSocialiteUser($request, $authUser);
        }else{
            // 根据第三方信息创建新用户
            $this->createUser($request);
        }

        return $this->issueToken($request);
    }

    /**
     * 添加第三方账号和user的关联
     *
     * @param SocialiteAuthRequest $request [description]
     * @param User    $user    [description]
     */
    private function addSocialiteUser(SocialiteAuthRequest $request, User $user){
        $data = $request->all();

        // 验证 provider + provider_user_id 唯一性
        $this->validate($request, [
            'provider' => ['required', Rule::unique('socialite_users')->where(function($query) use ($user) {
                return $query->where('user_id', $user->user_id);
            })],
            'provider_user_id' => 'required'
        ]);

        $data['user_id'] = $user->user_id;
        $this->repository->create($data);
    }

    /**
     * 创建用户和对应的第三方账号并关联
     *
     * @param SocialiteAuthRequest $request
     */
    private function createUser(SocialiteAuthRequest $request){
        $data = $request->all();

        DB::transaction( function () use ($request, $data){
            $user = $this->userRepository->create($data);
            $this->addSocialiteUser($request, $user);
        });
    }
}
