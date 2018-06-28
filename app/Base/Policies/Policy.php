<?php

namespace Yeelight\Base\Policies;

use Yeelight\Base\Models\BaseModel;
use Yeelight\Models\Foundation\BaseUser;

/**
 * Class Policy
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Policies
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class Policy
{
    /**
     * Get The owner
     *
     * @param BaseUser $user user
     * @param BaseModel $model model
     *
     * @return bool
     */
    public function owner(BaseUser $user, BaseModel $model)
    {
        return $model->getUserId() == $user->getUserId();
    }
}
