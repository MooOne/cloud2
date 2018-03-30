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
 * Yeelight\Models\Foundation\BaseUser
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read mixed $id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @mixin \Eloquent
 */
class BaseUser extends BaseModel implements BaseModelEventsInterface,
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

    function onCreating()
    {
        // TODO: Implement onCreating() method.
    }

    function onCreated()
    {
        // TODO: Implement onCreated() method.
    }

    function onUpdating()
    {
        // TODO: Implement onUpdating() method.
    }

    function onUpdated()
    {
        // TODO: Implement onUpdated() method.
    }

    function onSaving()
    {
        // TODO: Implement onSaving() method.
    }

    function onSaved()
    {
        // TODO: Implement onSaved() method.
    }

    function onDeleting()
    {
        // TODO: Implement onDeleting() method.
    }

    function onDeleted()
    {
        // TODO: Implement onDeleted() method.
    }

    function onRestoring()
    {
        // TODO: Implement onRestoring() method.
    }

    function onRestored()
    {
        // TODO: Implement onRestored() method.
    }
}
