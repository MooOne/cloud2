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
     * 动作标记
     * @var array
     */
    public $actionTags = [
        'list'     => 'list',
        'show'      => 'show',
        'create'    => 'create',
        'store'     => 'store',
        'edit'      => 'edit',
        'update'    => 'edit',
        'destroy'   => 'destroy'
    ];

    /**
     * 模型标记
     * @var
     */
    public $modelTag;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->initModelTag();
    }

    public function initModelTag()
    {
        $this->modelTag = strtolower((new \ReflectionClass($this))->getShortName());
    }
    /**
     * 添加权限标记
     *
     * @param $actionTags
     * @return array
     */
    public function addActionTags($actionTags)
    {
        $this->actionTags  = array_merge($this->actionTags, $actionTags);
        return $this->actionTags;
    }

    /**
     * 删除权限标记
     *
     * @param $actionTags
     * @return array
     */
    public function delActionTags($actionTags)
    {
        $this->actionTags  = array_diff($this->actionTags, $actionTags);
        return $this->actionTags;
    }

    /**
     * 根据action获取permission
     *
     * @param $action
     * @return null|string
     */
    public function getPermissionTag($action)
    {
        if (array_key_exists($action, $this->actionTags)) {
            return $this->actionTags[$action] . '-' . $this->modelTag;
        } else {
            return null;
        }
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