<?php

namespace Yeelight\Models\Foundation;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Yeelight\Base\Models\BaseModel;
use Yeelight\Models\Interfaces\BaseModelEventsInterface;

/**
 * Class BaseUser
 *
 * @category Yeelight
 *
 * @package Yeelight\Models\Foundation
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read mixed $id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @mixin \Eloquent
 */
class BaseUser extends BaseModel implements
    BaseModelEventsInterface,
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    Transformable
{
    use Authenticatable, Authorizable, CanResetPassword;
    use TransformableTrait;
    use HasApiTokens, Notifiable;

    const MORPH_NAME = 'User';

    /**
     * Indicates if the model should be auto set user_id.
     *
     * @var bool
     */
    protected $autoUserId = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    public function onCreating()
    {
        // TODO: Implement onCreating() method.
    }

    public function onCreated()
    {
        // TODO: Implement onCreated() method.
    }

    public function onUpdating()
    {
        // TODO: Implement onUpdating() method.
    }

    public function onUpdated()
    {
        // TODO: Implement onUpdated() method.
    }

    public function onSaving()
    {
        // TODO: Implement onSaving() method.
    }

    public function onSaved()
    {
        // TODO: Implement onSaved() method.
    }

    public function onDeleting()
    {
        // TODO: Implement onDeleting() method.
    }

    public function onDeleted()
    {
        // TODO: Implement onDeleted() method.
    }

    public function onRestoring()
    {
        // TODO: Implement onRestoring() method.
    }

    public function onRestored()
    {
        // TODO: Implement onRestored() method.
    }
}
