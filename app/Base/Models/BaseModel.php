<?php

namespace Yeelight\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Yeelight\Models\Foundation\BaseUser;
use Yeelight\Models\Interfaces\BaseModelEventsInterface;
use Yeelight\Traits\BaseModelEvents;

/**
 * Class BaseModel
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Models
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 *
 * @property-read mixed $id
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model implements BaseModelEventsInterface
{
    use BaseModelEvents;

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

    /**
     * Indicates timestamp is always saved in UTC timezone.
     *
     * @var bool
     */
    protected $timestampAlwaysUtc = false;

    /**
     * Indicates timestamp is always get in user timezone.
     *
     * @var bool
     */
    protected $getWithUserTimezone = true;

    /**
     * Get the auth instance.
     *
     * @return \Dingo\Api\Auth\Auth
     */
    protected function apiAuth()
    {
        return app('Dingo\Api\Auth\Auth');
    }

    /**
     * Get ID from the model primary key.
     *
     * @return mixed
     */
    public function getIdAttribute()
    {
        return $this->attributes[$this->getKeyName()];
    }

    /**
     * Get current auth user.
     *
     * @return BaseUser|null
     */
    public function getAuthUser()
    {
        $user = null;
        if ($this->apiAuth()->check()) { // API
            $user = $this->apiAuth()->user();
        } elseif (\Auth::guard(config('yeelight.backend.route.prefix'))->check()) {
            // Backend
            $user = \Auth::guard(config('yeelight.backend.route.prefix'))->user();
        } elseif (\Auth::check()) {
            // Normal
            $user = \Auth::user();
        }

        return $user;
    }

    /**
     * Get current auth user_id.
     *
     * @return mixed|null
     */
    public function getAuthUserId()
    {
        $user_id = null;
        $user = $this->getAuthUser();
        if ($user) {
            $user_id = isset($user->user_id) ? $user->user_id : $user->id;
        }

        return $user_id;
    }

    /**
     * Get current model's user_id.
     *
     * @return mixed|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Update the creation and update ips.
     *
     * @return void
     */
    protected function updateIps()
    {
        $ips = get_client_ip();

        if (!$this->isDirty('updated_ip')) {
            $this->updated_ip = $ips;
        }

        if (!$this->exists && !$this->isDirty('created_ip')) {
            $this->created_ip = $ips;
        }
    }

    /**
     * Update the creation and update by users.
     *
     * @return void
     */
    protected function updateUsers()
    {
        $user_id = $this->getAuthUserId();
        if (!($user_id > 0)) {
            return;
        }

        if (!$this->isDirty('updated_by')) {
            $this->updated_by = $user_id;
        }

        if (!$this->exists && !$this->isDirty('created_by')) {
            $this->created_by = $user_id;
        }
    }

    /**
     * 判断当前登陆者
     *
     * @return bool
     */
    public function isAuthUserOwner()
    {
        return $this->getAuthUserId() == $this->getUserId();
    }

    /**
     * 获取当前UTC时间
     *
     * @return Carbon
     */
    public function getNowUTCTime()
    {
        return Carbon::now('UTC');
    }

    /**
     * 获取当前Auth用户UTC时间
     *
     * @return Carbon
     */
    public function getNowAuthUserTime()
    {
        return Carbon::now($this->getAuthUserDateTimezone());
    }

    /**
     * 获取当前用户
     *
     * @return BaseUser|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * 获取关联用户
     *
     * @return BaseUser|null
     */
    public function getRelatedUser()
    {
        return $this->related_user;
    }

    /**
     * Set Model Presenter.
     *
     * @return $this
     * @throws \Exception
     */
    public function setModelPresenter()
    {
        $this->setPresenter(new ModelFractalPresenter());

        return $this;
    }

    /**
     * Return a timezone for all Datetime objects.
     *
     * @return mixed
     */
    public function getAuthUserDateTimezone()
    {
        $user = $this->getAuthUser();
        if ($user && !empty($user->timezone)) {
            return $user->timezone;
        } else {
            return app_timezone();
        }
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key The Attribute Name
     * @param mixed $value The Attribute Value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($this->timestampAlwaysUtc) {
            // set to UTC only if Carbon
            if ($value instanceof Carbon) {
                $value->setTimezone('UTC');
            }
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param string $key The Attribute Name
     *
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);

        if ($value instanceof Carbon && $this->getWithUserTimezone) {
            $value->setTimezone($this->getAuthUserDateTimezone());
        }

        return $value;
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date DateTime Interface
     *
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        if ($date instanceof Carbon && $this->getWithUserTimezone) {
            $date->setTimezone($this->getAuthUserDateTimezone());
        }

        return $date->format($this->getDateFormat());
    }
}
