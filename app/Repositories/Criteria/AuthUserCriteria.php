<?php

namespace Yeelight\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class AuthUserCriteria
 *
 * @category Yeelight
 *
 * @package Yeelight\Repositories\Criteria
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AuthUserCriteria implements CriteriaInterface
{
    /**
     * Apply
     *
     * @param $model
     * @param RepositoryInterface $repository RepositoryInterface
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', '=', current_auth_user()->user_id);

        return $model;
    }
}
