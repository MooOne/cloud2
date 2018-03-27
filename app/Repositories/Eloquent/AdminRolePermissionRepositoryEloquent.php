<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminRolePermissionRepository;
use Yeelight\Models\AdminRolePermission;
use Yeelight\Validators\AdminRolePermissionValidator;
use Yeelight\Presenters\AdminRolePermissionPresenter;

/**
 * Class AdminRolePermissionRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminRolePermissionRepositoryEloquent extends BaseRepository implements AdminRolePermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRolePermission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminRolePermissionValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminRolePermissionPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
