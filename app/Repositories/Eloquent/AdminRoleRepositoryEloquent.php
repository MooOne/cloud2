<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Models\AdminRole;
use Yeelight\Presenters\AdminRolePresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\AdminRoleRepository;
use Yeelight\Validators\AdminRoleValidator;

/**
 * Class AdminRoleRepositoryEloquent.
 */
class AdminRoleRepositoryEloquent extends BaseRepository implements AdminRoleRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name' => 'like',
        'slug' => 'like',
    ];

    /**
     * @var bool
     */
    protected $isSearchableForceAndWhere = true;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return AdminRole::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return AdminRoleValidator::class;
    }

    /**
     * Specify Presenter class name.
     *
     * @return mixed
     */
    public function presenter()
    {
        return AdminRolePresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
