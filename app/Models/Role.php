<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laratrust\Models\LaratrustRole;

/**
 * Yeelight\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yeelight\Models\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends LaratrustRole implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'id';

    protected $fillable = [];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    public static function boot() {
        parent::boot();

        static::roleAttached(function($user, $role, $team) {
        });
        static::roleSynced(function($user, $changes, $team) {
        });
    }

}
