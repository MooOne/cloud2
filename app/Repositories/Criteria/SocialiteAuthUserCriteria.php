<?php

namespace Yeelight\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;

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
