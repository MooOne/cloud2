<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Models\SocialiteUser;
use Yeelight\Presenters\SocialiteUserPresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\SocialiteUserRepository;
use Yeelight\Validators\SocialiteUserValidator;

/**
 * Class SocialiteUserRepositoryEloquent
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
class SocialiteUserRepositoryEloquent
    extends BaseRepository
    implements SocialiteUserRepository
{
    /**
     * $fieldSearchable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'provider',
        'provider_user_id',
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
        return SocialiteUser::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return SocialiteUserValidator::class;
    }

    /**
     * Specify Presenter class name.
     *
     * @return mixed
     */
    public function presenter()
    {
        return SocialiteUserPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
