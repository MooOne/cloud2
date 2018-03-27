<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminPermissionRepository;
use Yeelight\Models\AdminPermission;
use Yeelight\Validators\AdminPermissionValidator;
use Yeelight\Presenters\AdminPermissionPresenter;

/**
 * Class AdminPermissionRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminPermissionRepositoryEloquent extends BaseRepository implements AdminPermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminPermission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminPermissionValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminPermissionPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
