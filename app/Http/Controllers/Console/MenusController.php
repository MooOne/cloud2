<?php
namespace Yeelight\Http\Controllers\Console;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\MenuCreateRequest;
use Yeelight\Http\Requests\MenuUpdateRequest;
use Yeelight\Repositories\Interfaces\MenuRepository;
use Yeelight\Validators\MenuValidator;
use Yeelight\Http\Controllers\BaseController;

class MenusController extends BaseController
{

    /**
     * @var MenuRepository
     */
    protected $repository;

    /**
     * @var MenuValidator
     */
    protected $validator;

    public function __construct(MenuRepository $repository, MenuValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * 菜单列表
     *
     * @return $this
     */
    public function index()
    {
        $menus = $this->repository->getMenuList();
        return view('console.menu.index')->with(compact('menus'));
    }

    /**
     * 添加菜单视图
     *
     * @return $this
     */
    public function create()
    {
        $menus = $this->repository->getMenuList();
        return view('console.menu.create')->with(compact('menus'));
    }

    /**
     * 添加菜单
     *
     * @param MenuCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MenuCreateRequest $request)
    {
        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        $result = $this->repository->create($data);

        $responseData = [
            'status' => $result,
            'message' => $result ? trans('console/alert.menu.create_success') : trans('console/alert.menu.create_error')
        ];
        return $responseData;
    }


    /**
     * 查看菜单详细数据
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $menus = $this->repository->getMenuList();
        $menu = $this->repository->find($id);
        return view('console.menu.show')->with(compact('menu','menus'));
    }

    /**
     * 修改菜单视图
     *
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $menu = $this->repository->skipPresenter()->find($id);
        $menus = $this->repository->getMenuList();
        return view('console.menu.edit')->with(compact('menu','menus'));
    }

    /**
     * 修改菜单数据
     *
     * @param MenuUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MenuUpdateRequest $request, $id)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $result = $this->repository->update($data, $id);

        $responseData = [
            'status' => $result,
            'message' => $result ? trans('console/alert.menu.edit_success') : trans('console/alert.menu.edit_error')
        ];
        return $responseData;
    }


    /**
     * 删除菜单
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect('console/menu');
    }

    /**
     * 菜单排序
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderable()
    {
        $result = $this->repository->orderable(request('nestable',''));
        $responseData = [
            'status' => $result,
            'message' => $result ? trans('console/alert.menu.order_success') : trans('console/alert.menu.order_error')
        ];
        return $responseData;
    }
}
