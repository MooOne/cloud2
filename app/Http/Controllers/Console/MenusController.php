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

        $responseData = $this->repository->create($data);

        return response()->json($responseData);
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
        return view('admin.menu.show')->with(compact('menu','menus'));
    }

    /**
     * 修改菜单视图
     *
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $menu = $this->repository->find($id);
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

        $responseData = $this->repository->update($data, $id);

        return response()->json($responseData);

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
        $responseData = $this->repository->orderable(request('nestable',''));
        return response()->json($responseData);
    }
}
