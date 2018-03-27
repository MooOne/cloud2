<?php
namespace Yeelight\Http\Controllers\Backend;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\AdminOperationLogCreateRequest;
use Yeelight\Http\Requests\AdminOperationLogUpdateRequest;
use Yeelight\Repositories\Interfaces\AdminOperationLogRepository;
use Yeelight\Validators\AdminOperationLogValidator;

class AdminOperationLogsController extends BaseController
{

    /**
     * @var AdminOperationLogRepository
     */
    protected $repository;

    /**
     * @var AdminOperationLogValidator
     */
    protected $validator;

    public function __construct(AdminOperationLogRepository $repository, AdminOperationLogValidator $validator)
    {
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
     * @param  AdminOperationLogCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminOperationLogCreateRequest $request)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        $adminOperationLog = $this->repository->create($data);

        // throw exception if store failed
//        throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
//        return $this->response->created(null);

        // B. return data
        return $adminOperationLog;

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  AdminOperationLogUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AdminOperationLogUpdateRequest $request, $id)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $adminOperationLog = $this->repository->update($data, $id);

        // throw exception if update failed
//        throw new UpdateResourceFailedException('Failed to update.');

        // Updated, return 204 No Content
        return $this->response->noContent();

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
