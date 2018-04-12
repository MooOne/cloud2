<?php
namespace Yeelight\Http\Controllers\Backend;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\AdminUserPermissionCreateRequest;
use Yeelight\Http\Requests\AdminUserPermissionUpdateRequest;
use Yeelight\Repositories\Interfaces\AdminUserPermissionRepository;
use Yeelight\Validators\AdminUserPermissionValidator;

class AdminUserPermissionsController extends BaseController
{

    /**
     * @var AdminUserPermissionRepository
     */
    protected $repository;

    /**
     * @var AdminUserPermissionValidator
     */
    protected $validator;

    public function __construct(AdminUserPermissionRepository $repository, AdminUserPermissionValidator $validator)
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
     * @param  AdminUserPermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserPermissionCreateRequest $request)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        $adminUserPermission = $this->repository->create($data);

        // throw exception if store failed
//        throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
//        return $this->response->created(null);

        // B. return data
        return $adminUserPermission;

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
     * @param  AdminUserPermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AdminUserPermissionUpdateRequest $request, $id)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $adminUserPermission = $this->repository->update($data, $id);

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
