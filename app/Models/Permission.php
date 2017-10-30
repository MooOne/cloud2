<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laratrust\Models\LaratrustPermission;

/**
 * Yeelight\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yeelight\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends LaratrustPermission implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'id';

    protected $fillable = [];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

}
