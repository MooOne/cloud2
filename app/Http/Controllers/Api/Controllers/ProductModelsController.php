<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Yeelight\Http\Requests\Api\ProductModelCreateRequest;
use Yeelight\Http\Requests\Api\ProductModelUpdateRequest;
use Yeelight\Repositories\Interfaces\ProductModelRepository;
use Yeelight\Validators\ProductModelValidator;

/**
 * Class ProductModelsController
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
class ProductModelsController extends BaseController
{
    /**
     * ProductModelRepository
     *
     * @var ProductModelRepository
     */
    protected $repository;

    /**
     * ProductModelValidator
     *
     * @var ProductModelValidator
     */
    protected $validator;

    /**
     * ProductModelsController constructor.
     *
     * @param ProductModelRepository $repository ProductModelRepository
     * @param ProductModelValidator $validator ProductModelValidator
     */
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
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductModelCreateRequest $request ProductModelCreateRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductModelCreateRequest $request)
    {
        $data = $request->all();

        $productModel = $this->repository->create($data);

        // throw exception if store failed
        // throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
        // return $this->response->created(null);

        // B. return data
        return $this->response->created();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id id
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
     * @param ProductModelUpdateRequest $request ProductModelUpdateRequest
     * @param string $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductModelUpdateRequest $request, $id)
    {
        $data = $request->all();

        $productModel = $this->repository->update($data, $id);

        // throw exception if update failed
        // throw new UpdateResourceFailedException('Failed to update.');

        // Updated, return 204 No Content
        return $this->response->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if ($deleted) {
            // Deleted, return 204 No Content
            return $this->response->noContent();
        } else {
            // Failed, throw exception
            throw new DeleteResourceFailedException('Failed to delete.');
        }
    }
}
