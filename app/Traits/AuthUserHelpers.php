<?php
namespace Yeelight\Traits;

trait AuthUserHelpers
{

    /**
     * @return \Yeelight\Models\Foundation\User
     */
    public function getAuthUser()
    {
        return current_auth_user();
    }

    /**
     * @return mixed|null
     */
    public function getAuthUserId()
    {
        return $this->getAuthUser()->getUserId();
    }

}