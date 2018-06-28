<?php

namespace Yeelight\Http\Controllers\Backend;

use Illuminate\Support\MessageBag;
use Yeelight\Http\Requests\ProductModelCreateRequest;
use Yeelight\Http\Requests\ProductModelUpdateRequest;
use Yeelight\Repositories\Interfaces\ProductModelRepository;
use Yeelight\Validators\ProductModelValidator;

/**
 * Class ProductModelsController
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
class ProductModelsController extends BaseController
{
    /**
     * @var ProductModelRepository
     */
    protected $repository;

    /**
     * @var ProductModelValidator
     */
    protected $validator;

    public function __construct(
        ProductModelRepository $repository,
        ProductModelValidator $validator
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
        $columns = trans('product_models.columns');
        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.product_models.index', [
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
        $columns = trans('product_models.columns');

        return view('backend.product_models.create', [
            'columns' => $columns,
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
        $columns = trans('product_models.columns');

        return view('backend.product_models.edit', [
            'data'    => $data['data'],
            'columns' => $columns,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductModelCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductModelCreateRequest $request)
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

            return redirect(route('product_models.create'))->with(compact('error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductModelUpdateRequest $request
     * @param int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductModelUpdateRequest $request, $id)
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
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
