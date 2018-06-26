<?php

namespace Yeelight\Http\Controllers\Backend;

use Yeelight\Models\AdminOperationLog;
use Yeelight\Repositories\Interfaces\AdminOperationLogRepository;
use Yeelight\Repositories\Interfaces\AdminUserRepository;
use Yeelight\Validators\AdminOperationLogValidator;

/**
 * Class AdminOperationLogsController
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
    ) {
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
        $lists = $this->repository->orderBy('created_at', 'desc')->paginate(null, ['*']);
        $paginator = $this->backendPagination($lists);

        //导出
        $this->setupExporter();

        return view('backend.admin_operation_logs.index', [
            'lists'      => $lists,
            'columns'    => $columns,
            'adminUsers' => $adminUsers,
            'methods'    => AdminOperationLog::$methods,
            'paginator'  => $paginator,
            'query'      => request()->query(),
        ]);
    }
}
