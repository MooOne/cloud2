<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Yeelight\Http\Requests\Api\ProductModelCreateRequest;
use Yeelight\Http\Requests\Api\ProductModelUpdateRequest;
use Yeelight\Repositories\Interfaces\ProductModelRepository;
use Yeelight\Validators\ProductModelValidator;

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
        return $this->repository->all();
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
     * @param string                    $id
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
     * @param int $id
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
