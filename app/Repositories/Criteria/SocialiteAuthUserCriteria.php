<?php

namespace Yeelight\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;

/**
 * Class SocialiteAuthUserCriteria
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
class SocialiteAuthUserCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(SocialiteAuthRequest $request)
    {
        $this->request = $request;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
            ->where('provider', '=', $this->request->provider)
            ->where('provider_user_id', '=', $this->request->provider_user_id);

        return $model;
    }
}
