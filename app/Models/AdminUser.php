<?php

namespace Yeelight\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Prettus\Repository\Traits\TransformableTrait;
use Yeelight\Services\Image\Models\Traits\YeelightHasOneImageTrait;
use Yeelight\Services\Image\Models\Traits\YeelightUploadOneImageTrait;
use Yeelight\Traits\HasPermissions;

/**
 * Class AdminUser
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
 */
class AdminUser extends BaseModel implements AuthenticatableContract
{
    use TransformableTrait,
        Authenticatable,
        HasPermissions,
        YeelightHasOneImageTrait,
        YeelightUploadOneImageTrait;

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = false;

    /**
     * Indicates if the model should be recorded ips.
     *
     * @var bool
     */
    protected $ips = false;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = false;

    protected $primaryKey = 'id';

    protected $fillable = ['username', 'password', 'name', 'yeelight_image_id'];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('yeelight.backend.database.admin_users_table'));

        parent::__construct($attributes);
    }

    public function onCreating()
    {
        parent::onCreating();

        //密码
        $this->password = bcrypt($this->password);

        //头像
        $yeelightImage = $this->uploadOne('avatar');
        $this->yeelight_image_id = $yeelightImage ? $yeelightImage->getYeelightImageId() : null;
    }

    public function onCreated()
    {
        parent::onCreated();

        //头像
        if ($this->yeelight_image_id) {
            $this->yeelight_image->user_id = $this->attributes[$this->getKeyName()];
            $this->yeelight_image->save();
        }

        //权限
        $permissions = array_filter(request()->get('permissions', []));
        if (!empty($permissions)) {
            $this->permissions()->sync($permissions);
        }

        //角色
        $roles = array_filter(request()->get('roles', []));
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function onUpdating()
    {
        parent::onUpdating();

        //密码
        if (request()->get('password')
            && $this->password != request()->get('password')
        ) {
            $this->password = bcrypt(request()->get('password'));
        }

        //头像
        $yeelightImage = $this->uploadOne('avatar');
        if ($yeelightImage) {
            $this->yeelight_image_id = $yeelightImage->getYeelightImageId();
            $this->yeelight_image->user_id = $this->attributes[$this->getKeyName()];
            $this->yeelight_image->save();
        }

        //权限
        $permissions = array_filter(request()->get('permissions', []));
        if (!empty($permissions)) {
            $this->permissions()->sync($permissions);
        }

        //角色
        $roles = array_filter(request()->get('roles', []));
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function onDeleting()
    {
        parent::onDeleting();

        //权限
        $this->permissions()->sync([]);

        //角色
        $this->roles()->sync([]);
    }
}
