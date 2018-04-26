<?php
namespace Yeelight\Models;

use Yeelight\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends BaseModel implements Transformable
{
    use TransformableTrait;

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = true;

    /**
     * Indicates if the model should be recorded ips.
     *
     * @var bool
     */
    protected $ips = true;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = true;

    protected $primaryKey = 'id';

    protected $fillable = [
		'name',
		'gender',
		'birthday',
		'country',
		'timezone',
		'locale',
		'username',
		'phone_number',
		'email',
		'password',
		'status',
	];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

}
