<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminUserPermissionRepository;
use Yeelight\Models\AdminUserPermission;
use Yeelight\Validators\AdminUserPermissionValidator;
use Yeelight\Presenters\AdminUserPermissionPresenter;

/**
 * Class AdminUserPermissionRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminUserPermissionRepositoryEloquent extends BaseRepository implements AdminUserPermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminUserPermission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminUserPermissionValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminUserPermissionPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
