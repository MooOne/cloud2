<?php

namespace Yeelight\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Yeelight\Models\Foundation\User;

/**
 * Class SocialiteUser
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
class SocialiteUser extends BaseModel implements Transformable
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

    protected $primaryKey = 'socialite_user_id';

    protected $fillable = [
        'user_id',
        'provider',
        'provider_user_id',
        'oauth_data',
        'expires_at',
    ];

    // Fields to be converted to Carbon object automatically
    protected $dates = [];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
