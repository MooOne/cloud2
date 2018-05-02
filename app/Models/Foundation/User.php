<?php
namespace Yeelight\Models\Foundation;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Yeelight\Models\SocialiteUser;
use Yeelight\Services\Image\Models\Traits\YeelightHasImageablesTrait;
use Yeelight\Models\Foundation\BaseUser;

/**
 * Yeelight\Models\Foundation\User
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read mixed $id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yeelight\Models\Image\YeelightImage[] $images
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yeelight\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yeelight\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User wherePermissionIs($permission = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereRoleIs($role = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Yeelight\Models\Foundation\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends BaseUser
{
    use YeelightHasImageablesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'gender', 'birthday', 'country', 'timezone', 'locale', 'username', 'phone_number', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function socialiteUser(){
        return $this->hasMany(SocialiteUser::class);
    }

    public function findForPassport($username) {
        return $this->where('username', $username)->orWhere('email', $username)->first();
    }


    /**
     * Called when model is creating
     * Other events available are in BaseModelEvents
     */
    public function onCreating()
    {
        parent::onCreated();

        //密码
        $this->password = bcrypt($this->password);
    }

    /**
     * Called when model is created
     * Other events available are in BaseModelEvents
     */
    public function onCreated()
    {
        parent::onCreated();
    }
}
