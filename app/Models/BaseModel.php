<?php

namespace Yeelight\Models;

use Yeelight\Base\Models\BaseModel as Model;
use Yeelight\Models\Foundation\User;

/**
 * Class BaseModel
 *
 * @category Yeelight
 *
 * @package Yeelight\Models
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 *
 * @property-read mixed $id
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    /**
     * 模型标记.
     *
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
