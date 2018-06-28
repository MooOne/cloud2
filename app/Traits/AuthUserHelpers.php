<?php

namespace Yeelight\Traits;

/**
 * Trait AuthUserHelpers
 *
 * @category Yeelight
 *
 * @package Yeelight\Traits
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
trait AuthUserHelpers
{
    /**
     * GetAuthUser
     *
     * @return \Yeelight\Models\Foundation\User
     */
    public function getAuthUser()
    {
        return current_auth_user();
    }

    /**
     * GetAuthUserId
     *
     * @return mixed|null
     */
    public function getAuthUserId()
    {
        return $this->getAuthUser()->getUserId();
    }
}
