<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\AdminPermissionCreateRequest;
use Yeelight\Http\Requests\AdminPermissionUpdateRequest;
use Yeelight\Models\AdminPermission;
use Yeelight\Repositories\Interfaces\AdminPermissionRepository;
use Yeelight\Validators\AdminPermissionValidator;

/**
 * Class AdminPermissionsController
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
class AdminPermissionsController extends BaseController
{
    /**
     * @var AdminPermissionRepository
     */
    protected $repository;

    /**
     * @var AdminPermissionValidator
     */
    protected $validator;

    public function __construct(
        AdminPermissionRepository $repository,
        AdminPermissionValidator $validator
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $columns = trans('admin_permissions.columns');
        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.admin_permissions.index', [
            'lists'       => $lists,
            'columns'     => $columns,
            'httpMethods' => AdminPermission::$httpMethods,
            'paginator'   => $paginator,
            'query'       => request()->query(),
        ]);
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $columns = trans('admin_permissions.columns');

        return view('backend.admin_permissions.create', [
            'columns'     => $columns,
            'httpMethods' => AdminPermission::$httpMethods,
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
        $columns = trans('admin_permissions.columns');

        return view('backend.admin_permissions.edit', [
            'data'        => $data['data'],
            'columns'     => $columns,
            'httpMethods' => AdminPermission::$httpMethods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminPermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPermissionCreateRequest $request)
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

            return redirect(route('permissions.create'))->with(compact('error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminPermissionUpdateRequest $request
     * @param int                          $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPermissionUpdateRequest $request, $id)
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
}
