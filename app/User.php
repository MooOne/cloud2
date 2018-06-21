<?php

namespace Yeelight;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Yeelight\User.
 *
 * @property int $user_id
 * @property string $name
 * @property string|null $gender
 * @property string|null $birthday
 * @property string|null $country
 * @property string|null $timezone
 * @property string|null $locale
 * @property string|null $username
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $password
 * @property string|null $remember_token
 * @property int $status
 * @property int|null $created_by
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $created_ip
 * @property int|null $updated_by
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $updated_ip
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
