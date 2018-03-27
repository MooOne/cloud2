<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminRoleUserRepository;
use Yeelight\Models\AdminRoleUser;
use Yeelight\Validators\AdminRoleUserValidator;
use Yeelight\Presenters\AdminRoleUserPresenter;

/**
 * Class AdminRoleUserRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminRoleUserRepositoryEloquent extends BaseRepository implements AdminRoleUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRoleUser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminRoleUserValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminRoleUserPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
