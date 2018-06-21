<?php

namespace Yeelight\Http\Controllers\Api\Controllers;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Yeelight\Http\Requests\Api\UserUpdateRequest;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\UserValidator;

class UsersController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Get current logged in User info.
     *
     * @return mixed
     */
    public function me()
    {
        return $this->repository->find($this->getAuthUserId());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request)
    {
        $data = $request->all();

        $this->repository->update($data, $this->getAuthUserId());

        // throw exception if update failed
//        throw new UpdateResourceFailedException('Failed to update.');

        // Updated, return 204 No Content
        return $this->response->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $deleted = $this->repository->delete($this->getAuthUserId());

        if ($deleted) {
            // Deleted, return 204 No Content
            return $this->response->noContent();
        } else {
            // Failed, throw exception
            throw new DeleteResourceFailedException('Failed to delete.');
        }
    }
}
