<?php

namespace Yeelight\Http\Controllers\Api\Auth\Provider;

/**
 * Class OAuth2
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Auth\Provider
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class OAuth2 extends \Dingo\Api\Auth\Provider\JWT
{
    /**
     * GetResource
     *
     * @return \League\OAuth2\Server\ResourceServer
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * GetAccessToken
     *
     * @return \Laravel\Passport\Bridge\AccessToken
     */
    public function getAccessToken()
    {
        return $this->resource->getAccessToken();
    }

    /**
     * GetSession
     *
     * @return \Laravel\Passport\Bridge\SessionEntity
     */
    public function getSession()
    {
        return $this->getAccessToken()->getSession();
    }

    /**
     * Get the resource owner ID of the current request.
     *
     * @return string
     */
    public function getResourceOwnerId()
    {
        return $this->getSession()->getOwnerId();
    }

    /**
     * Get the resource owner type of the current request (client or user).
     *
     * @return string
     */
    public function getResourceOwnerType()
    {
        return $this->getSession()->getOwnerType();
    }

    /**
     * Get the client of the current request.
     *
     * @return \Laravel\Passport\Bridge\Client
     */
    public function getClient()
    {
        return $this->getSession()->getClient();
    }

    /**
     * Get the client id of the current request.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->getClient()->getId();
    }
}
