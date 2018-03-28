<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Yeelight\Models\Traits\HasPermissions;

class AdminUser extends BaseModel implements AuthenticatableContract
{
    use TransformableTrait, Authenticatable, HasPermissions;

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

    protected $fillable = ['username', 'password', 'name', 'avatar'];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('yeelight.backend.database.admin_users_table'));

        parent::__construct($attributes);
    }
}
