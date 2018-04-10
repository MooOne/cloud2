<?php
namespace Yeelight\Http\Controllers\Backend;

use Dingo\Api\Exception\DeleteResourceFailedException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Http\Requests\AdminOperationLogCreateRequest;
use Yeelight\Http\Requests\AdminOperationLogUpdateRequest;
use Yeelight\Models\AdminOperationLog;
use Yeelight\Repositories\Interfaces\AdminOperationLogRepository;
use Yeelight\Validators\AdminOperationLogValidator;
use Yeelight\Repositories\Interfaces\AdminUserRepository;

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

    /**
     * @var AdminUserRepository
     */
    private $userRepository;

    public function __construct(
        AdminOperationLogRepository $repository,
        AdminOperationLogValidator $validator,
        AdminUserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = trans('admin_operation_logs.columns');
        $adminUsers = $this->userRepository->pluck('name', 'id');
        $lists = $this->repository->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.admin_operation_logs.index', [
            'lists' => $lists,
            'columns' => $columns,
            'adminUsers' => $adminUsers,
            'methods' => AdminOperationLog::$methods,
            'paginator' => $paginator,
            'query' => request()->query()
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
