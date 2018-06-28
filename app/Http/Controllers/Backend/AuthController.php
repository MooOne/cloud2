<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-20
 * Time: 下午4:46.
 */

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Controllers\BaseController;
use Yeelight\Http\Requests\AdminUserSettingRequest;
use Yeelight\Repositories\Interfaces\AdminUserRepository;
use Yeelight\Validators\AdminUserValidator;

/**
 * Class AuthController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend
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
     * @var AdminUserRepository
     */
    protected $repository;

    /**
     * @var AdminUserValidator
     */
    protected $validator;

    public function __construct(
        AdminUserRepository $repository,
        AdminUserValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * User setting page.
     *
     * @return mixed
     */
    public function getSetting()
    {
        $columns = trans('admin_users.columns');

        return view('backend.auth.setting', [
            'data'    => $this->getAuthUser()->toArray(),
            'columns' => $columns,
        ]);
    }

    /**
     * Update user setting.
     *
     * @param AdminUserSettingRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putSetting(AdminUserSettingRequest $request)
    {
        $data = $request->all();

        $id = $this->getAuthUserId();

        $result = $this->repository->update($data, $id);

        if ($result) {
            backend_toastr(trans('backend.update_succeeded'));

            return redirect(backend_base_path('auth/setting'));
        } else {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.update_failed'),
            ]);

            return redirect(backend_base_path('auth/setting'))->with(compact('error'));
        }
    }
}
