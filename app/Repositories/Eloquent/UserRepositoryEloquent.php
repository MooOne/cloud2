<?php

namespace Yeelight\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Yeelight\Models\Foundation\User;
use Yeelight\Presenters\UserPresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\UserRepository;
use Yeelight\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent
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
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * $fieldSearchable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name'     => 'like',
        'username' => 'like',
        'email'    => 'like',
        'gender',
        'country',
        'timezone' => 'like',
        'locale',
        'phone_number' => 'like',
    ];

    /**
     * $isSearchableForceAndWhere
     *
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
        return User::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return UserValidator::class;
    }

    /**
     * Specify Presenter class name.
     *
     * @return mixed
     */
    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * ByUserIds
     *
     * @param array|Collection $userIds Collection
     *
     * @return $this
     */
    public function byUserIds($userIds)
    {
        $this->model = $this->model->whereIn('user_id', $userIds);

        return $this;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
