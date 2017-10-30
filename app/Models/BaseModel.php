<?php
namespace Yeelight\Models;

use Yeelight\Base\Models\BaseModel as Model;
use Yeelight\Models\Foundation\User;

/**
 * Yeelight\Models\BaseModel
 *
 * @property-read mixed $id
 * @mixin \Eloquent
 */
class BaseModel extends Model
{

    /**
     * @return User|null
     */
    public function getUser()
    {
        return parent::getUser();
    }

    /**
     * @return User|null
     */
    public function getAuthUser()
    {
        return parent::getAuthUser();
    }

    /**
     * @return User|null
     */
    public function getRelatedUser()
    {
        return $this->related_user;
    }


}