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
     * 模型标记
     * @var
     */
    public $modelTag;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function initModelTag()
    {
        $this->modelTag = strtolower((new \ReflectionClass($this))->getShortName());
    }

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