<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\AdminRoleCreateRequest;
use Yeelight\Http\Requests\AdminRoleUpdateRequest;
use Yeelight\Models\AdminPermission;
use Yeelight\Repositories\Interfaces\AdminRoleRepository;
use Yeelight\Validators\AdminRoleValidator;

/**
 * Class AdminRolesController
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
class AdminRolesController extends BaseController
{
    /**
     * @var AdminRoleRepository
     */
    protected $repository;

    /**
     * @var AdminRoleValidator
     */
    protected $validator;

    public function __construct(
        AdminRoleRepository $repository,
        AdminRoleValidator $validator
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
        $columns = trans('admin_roles.columns');
        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.admin_roles.index', [
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
        $columns = trans('admin_roles.columns');
        $permissions = AdminPermission::all()->pluck('name', 'id');

        return view('backend.admin_roles.create', [
            'columns'     => $columns,
            'permissions' => $permissions,
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
        $columns = trans('admin_roles.columns');

        return view('backend.admin_roles.edit', [
            'data'        => $data['data'],
            'columns'     => $columns,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminRoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRoleCreateRequest $request)
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
     * @param AdminRoleUpdateRequest $request
     * @param int                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRoleUpdateRequest $request, $id)
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
                'message' => trans('admin_roles.not_allow_delete_administrator'),
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
