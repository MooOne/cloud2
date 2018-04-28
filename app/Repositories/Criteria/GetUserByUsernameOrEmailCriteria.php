<?php
namespace Yeelight\Repositories\Criteria;

use Illuminate\Support\Facades\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;

class GetUserByUsernameOrEmailCriteria implements CriteriaInterface
{

    public function __construct(SocialiteAuthRequest $request)
    {
        $this->request = $request;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->request->email) {
            $model = $model
                ->where('email', '=', $this->request->email)
                ->orWhere('username', '=', $this->request->username);
        } else {
            $model = $model->where('username', '=', $this->request->username);
        }

        return $model;
    }

}