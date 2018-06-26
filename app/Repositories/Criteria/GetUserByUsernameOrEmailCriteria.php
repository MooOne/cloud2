<?php

namespace Yeelight\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Yeelight\Http\Requests\Api\SocialiteAuthRequest;

/**
 * Class GetUserByUsernameOrEmailCriteria
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
                ->orWhere('email', '=', $this->request->username)
                ->orWhere('username', '=', $this->request->username);
        } else {
            $model = $model
                ->where('username', '=', $this->request->username)
                ->orWhere('email', '=', $this->request->username);
        }

        return $model;
    }
}
