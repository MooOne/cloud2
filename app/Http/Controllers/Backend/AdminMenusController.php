<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\AdminMenuCreateRequest;
use Yeelight\Http\Requests\AdminMenuUpdateRequest;
use Yeelight\Models\AdminRole;
use Yeelight\Repositories\Interfaces\AdminMenuRepository;
use Yeelight\Services\Tree\Tree;
use Yeelight\Validators\AdminMenuValidator;

/**
 * Class AdminMenusController
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
class AdminMenusController extends BaseController
{
    /**
     * @var AdminMenuRepository
     */
    protected $repository;

    /**
     * @var AdminMenuValidator
     */
    protected $validator;

    public function __construct(
        AdminMenuRepository $repository,
        AdminMenuValidator $validator
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
        $columns = trans('admin_menus.columns');
        $treeView = $this->treeView()->render();
        $menus = $this->repository->makeModel()->selectOptions();
        $roles = AdminRole::all()->pluck('name', 'id');

        return view('backend.admin_menus.index', [
            'treeView' => $treeView,
            'columns'  => $columns,
            'menus'    => $menus,
            'roles'    => $roles,
        ]);
    }

    /**
     * 返回菜单列表.
     *
     * @return Tree
     */
    protected function treeView()
    {
        return new Tree($this->repository->makeModel(), function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

                if (!isset($branch['children'])) {
                    if (url()->isValidUrl($branch['uri'])) {
                        $uri = $branch['uri'];
                    } else {
                        $uri = backend_base_path($branch['uri']);
                    }

                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
                }

                return $payload;
            });
        });
    }

    /**
     * Edit.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = $this->repository->find($id);
        $columns = trans('admin_menus.columns');
        $menus = $this->repository->makeModel()->selectOptions();
        $roles = AdminRole::all()->pluck('name', 'id');

        return view('backend.admin_menus.edit', [
            'data'    => $data['data'],
            'columns' => $columns,
            'roles'   => $roles,
            'menus'   => $menus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminMenuCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminMenuCreateRequest $request)
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

            return redirect(route('menus.index'))->with(compact('error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminMenuUpdateRequest $request
     * @param int                    $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AdminMenuUpdateRequest $request, $id)
    {
        $data = $request->all();

        if ($data['parent_id'] && $data['parent_id'] == $id) {
            $error = new MessageBag([
                'title'   => trans('backend.failed'),
                'message' => trans('backend.parent_select_error'),
            ]);

            return redirect($request->session()->previousUrl())->with(compact('error'));
        }

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
     * 菜单排序.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function order()
    {
        if (Request::has('_order')) {
            $order = Request::input('_order');

            Request::offsetUnset('_order');

            $this->repository->saveOrder(json_decode_safe($order, true));

            return response()->json([
                'status'  => true,
                'message' => trans('backend.save_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('backend.save_failed'),
            ]);
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
