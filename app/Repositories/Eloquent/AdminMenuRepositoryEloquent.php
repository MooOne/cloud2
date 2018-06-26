<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Models\AdminMenu;
use Yeelight\Presenters\AdminMenuPresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminMenuRepository;
use Yeelight\Validators\AdminMenuValidator;

/**
 * Class AdminMenuRepositoryEloquent
 *
 * @category Yeelight
 *
 * @package Yeelight\Repositories\Eloquent
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminMenuRepositoryEloquent extends BaseRepository implements AdminMenuRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return AdminMenu::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return AdminMenuValidator::class;
    }

    /**
     * Specify Presenter class name.
     *
     * @return mixed
     */
    public function presenter()
    {
        return AdminMenuPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Save tree order from a tree like array.
     *
     * @param array $tree tree
     * @param int $parentId parentId
     *
     * @return void
     */
    public function saveOrder($tree = [], $parentId = 0)
    {
        $this->model->saveOrder($tree, $parentId);
    }
}
