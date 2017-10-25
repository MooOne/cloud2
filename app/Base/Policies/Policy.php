<?php
namespace Yeelight\Base\Policies;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Model\Foundation\User;

abstract class Policy
{

    /**
     * @param User $user
     * @param BaseModel $model
     * @return bool
     */
    public function owner(User $user, BaseModel $model)
    {
        return $model->getUserId() == $user->getUserId();
    }

}
