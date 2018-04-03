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
        $columns = trans('admin_operation_logs.columns');
        $operationLogs = $this->repository->paginate(null, ['*']);

        return view('backend.admin_operation_logs.index', [
            'lists' => $operationLogs,
            'columns' => $columns
        ]);
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
