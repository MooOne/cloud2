<?php

namespace Yeelight\Base\Policies;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Models\Foundation\BaseUser;

abstract class Policy
{
    /**
     * @param BaseUser  $user
     * @param BaseModel $model
     *
     * @return bool
     */
    public function owner(BaseUser $user, BaseModel $model)
    {
        return $model->getUserId() == $user->getUserId();
    }
}
