<?php

namespace Yeelight\Models\Foundation;

use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;
use Yeelight\Models\SocialiteUser;
use Yeelight\Services\Image\Models\Traits\YeelightHasImageablesTrait;

/**
 * Yeelight\Models\Foundation\User.
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
 *
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
    protected $ips = true;

    /**
     * Indicates if the model should be recorded users.
     *
     * @var bool
     */
    protected $update_users = true;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'gender', 'birthday', 'country',
        'timezone', 'locale', 'username',
        'phone_number', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * SocialiteUsers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialiteUsers()
    {
        return $this->hasMany(SocialiteUser::class, 'user_id', 'user_id');
    }

    /**
     * AccessTokens
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessTokens()
    {
        return $this->hasMany(Token::class, 'user_id', 'user_id');
    }

    /**
     * FindForPassport
     *
     * @param string $username username
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object|User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->orWhere('email', $username)->first();
    }

    /**
     * Called when model is updating
     * Other events available are in BaseModelEvents.
     */
    public function onUpdating()
    {
        parent::onUpdating();

        //密码
        if (request()->get('password') && $this->password != request()->get('password')) {
            $this->password = bcrypt(request()->get('password'));
        }

        //phone
        $this->phone_number = phone_model_from($this->phone_number, $this->country)->format_e164;
    }

    /**
     * Called when model is creating
     * Other events available are in BaseModelEvents.
     */
    public function onCreating()
    {
        parent::onCreating();

        //密码
        $this->password = bcrypt($this->password);

        //phone
        $this->phone_number = phone_model_from($this->phone_number, $this->country)->format_e164;
    }

    /**
     * Called when model is created
     * Other events available are in BaseModelEvents.
     */
    public function onCreated()
    {
        parent::onCreated();
    }

    public function onSaving()
    {
        // update ips if true
        if ($this->ips) {
            $this->updateIps();
        }

        // update users if true
        if ($this->update_users) {
            $this->updateUsers();
        }
    }

    public function onDeleting()
    {
        parent::onDeleting();

        //关联的第三方
        $this->socialiteUsers()->delete();

        //Token相关
        $accessTokens = $this->accessTokens;

        foreach ($accessTokens as $accessToken) {
            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);
            $accessToken->revoke();
        }
    }
}
