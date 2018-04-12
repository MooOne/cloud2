<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminRoleMenuRepository;
use Yeelight\Models\AdminRoleMenu;
use Yeelight\Validators\AdminRoleMenuValidator;
use Yeelight\Presenters\AdminRoleMenuPresenter;

/**
 * Class AdminRoleMenuRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminRoleMenuRepositoryEloquent extends BaseRepository implements AdminRoleMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRoleMenu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminRoleMenuValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminRoleMenuPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
