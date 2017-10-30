<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laratrust\Models\LaratrustTeam;

/**
 * Yeelight\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends LaratrustTeam implements Transformable
{
    use TransformableTrait;

    protected $primaryKey = 'id';

    protected $fillable = [];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

}
