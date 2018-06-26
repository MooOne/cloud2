<?php

namespace Yeelight\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminRole
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
class AdminRole extends BaseModel implements Transformable
{
    use TransformableTrait;

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

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    protected $fillable = ['name', 'slug'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('yeelight.backend.database.admin_roles_table'));

        parent::__construct($attributes);
    }

    /**
     * A role belongs to many users.
     *
     * @return BelongsToMany
     */
    public function administrators() : BelongsToMany
    {
        $pivotTable = config('yeelight.backend.database.admin_role_users_table');

        $relatedModel = config('yeelight.backend.database.admin_users_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'user_id');
    }

    /**
     * A role belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions() : BelongsToMany
    {
        $pivotTable = config('yeelight.backend.database.admin_role_permissions_table');

        $relatedModel = config('yeelight.backend.database.admin_permissions_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'role_id', 'permission_id')->withTimestamps();
    }

    /**
     * Check user has permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function can(string $permission) : bool
    {
        return $this->permissions()->where('slug', $permission)->exists();
    }

    /**
     * Check user has no permission.
     *
     * @param $permission
     *
     * @return bool
     */
    public function cannot(string $permission) : bool
    {
        return !$this->can($permission);
    }

    public function onCreated()
    {
        parent::onCreated();
        $permissions = array_filter(request()->get('permissions', []));
        if (!empty($permissions)) {
            $this->permissions()->sync($permissions);
        }
    }

    public function onUpdated()
    {
        parent::onUpdated();
        $permissions = array_filter(request()->get('permissions', []));
        if (!empty($permissions)) {
            $this->permissions()->sync($permissions);
        }
    }

    public function onDeleting()
    {
        parent::onDeleting();
        $this->administrators()->detach();
        $this->permissions()->sync([]);
    }
}
