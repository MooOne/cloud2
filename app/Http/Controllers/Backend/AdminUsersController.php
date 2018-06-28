<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\AdminUserCreateRequest;
use Yeelight\Http\Requests\AdminUserUpdateRequest;
use Yeelight\Models\AdminPermission;
use Yeelight\Models\AdminRole;
use Yeelight\Repositories\Interfaces\AdminUserRepository;
use Yeelight\Validators\AdminUserValidator;

/**
 * Class AdminUsersController
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
class AdminUsersController extends BaseController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = trans('admin_users.columns');
        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.admin_users.index', [
            'lists'     => $lists,
            'columns'   => $columns,
            'paginator' => $paginator,
            'query'     => request()->query(),
        ]);
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $columns = trans('admin_users.columns');
        $permissions = AdminPermission::all()->pluck('name', 'id');
        $roles = AdminRole::all()->pluck('name', 'id');

        return view('backend.admin_users.create', [
            'columns'     => $columns,
            'permissions' => $permissions,
            'roles'       => $roles,
        ]);
    }

    /**
     * Edit.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->repository->find($id);
        $permissions = AdminPermission::all()->pluck('name', 'id');
        $roles = AdminRole::all()->pluck('name', 'id');
        $columns = trans('admin_users.columns');

        return view('backend.admin_users.edit', [
            'data'        => $data['data'],
            'columns'     => $columns,
            'permissions' => $permissions,
            'roles'       => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserCreateRequest $request)
    {
        $data = $request->all();

        $result = $this->repository->create($data);

        if ($result) {
            return $this->redirectAfterStore();
        } else {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.save_failed'),
            ]);

            return redirect(route('roles.create'))->with(compact('error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUserUpdateRequest $request
     * @param int                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserUpdateRequest $request, $id)
    {
        $data = $request->all();

        $result = $this->repository->update($data, $id);

        if ($result) {
            return $this->redirectAfterUpdate();
        } else {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.update_failed'),
            ]);

            return redirect($request->session()->previousUrl())->with(compact('error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);

        // 不能删除超级管理员
        if (in_array(1, $ids)) {
            return response()->json([
                'status'  => false,
                'message' => trans('admin_users.not_allow_delete_administrator'),
            ]);
        }

        $deleted = $this->repository->deleteIn($ids);

        if ($deleted) {
            return response()->json([
                'status'  => true,
                'message' => trans('backend.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('backend.delete_failed'),
            ]);
        }
    }
}
