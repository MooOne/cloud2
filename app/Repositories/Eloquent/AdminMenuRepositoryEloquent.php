<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminMenuRepository;
use Yeelight\Models\AdminMenu;
use Yeelight\Validators\AdminMenuValidator;
use Yeelight\Presenters\AdminMenuPresenter;

/**
 * Class AdminMenuRepositoryEloquent
 * @package namespace Yeelight\Repositories\Eloquent;
 */
class AdminMenuRepositoryEloquent extends BaseRepository implements AdminMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminMenu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdminMenuValidator::class;
    }


    /**
    * Specify Presenter class name
    *
    * @return mixed
    */
    public function presenter()
    {

        return AdminMenuPresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Save tree order from a tree like array.
     *
     * @param array $tree
     * @param int   $parentId
     */
    public function saveOrder($tree = [], $parentId = 0)
    {
        $this->model->saveOrder($tree, $parentId);
    }
}
