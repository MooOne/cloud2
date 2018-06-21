<?php

namespace Yeelight\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AdminRolePermission extends BaseModel implements Transformable
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

    protected $fillable = [];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];
}
