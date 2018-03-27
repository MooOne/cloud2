<?php
namespace Yeelight\Http\Controllers\Backend;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\AdminUserCreateRequest;
use Yeelight\Http\Requests\AdminUserUpdateRequest;
use Yeelight\Repositories\Interfaces\AdminUserRepository;
use Yeelight\Validators\AdminUserValidator;
use Yeelight\Http\Controllers\BaseController;

class AdminUsersController extends BaseController
{

    /**
     * @var AdminUserRepository
     */
    protected $repository;

    /**
     * @var AdminUserValidator
     */
    protected $validator;

    public function __construct(AdminUserRepository $repository, AdminUserValidator $validator)
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
     * @param  AdminUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserCreateRequest $request)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

        $adminUser = $this->repository->create($data);

        // throw exception if store failed
//        throw new StoreResourceFailedException('Failed to store.');

        // A. return 201 created
//        return $this->response->created(null);

        // B. return data
        return $adminUser;

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
     * @param  AdminUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AdminUserUpdateRequest $request, $id)
    {

        $data = $request->all();

        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $adminUser = $this->repository->update($data, $id);

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
