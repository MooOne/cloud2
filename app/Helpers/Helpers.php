<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 17-10-25
 * Time: 下午4:51
 */

if (!function_exists('auth_user')) {

    /**
     * @param bool $throwException
     * @return null|\Yeelight\Model\Foundation\User|\Yeelight\Model\Foundation\User
     */
    function auth_user($throwException = true)
    {
        return current_auth_user($throwException);
    }

}

if (!function_exists('smart_mix')) {

    function smart_mix($path, $manifestDirectory = '', $supportHot = true)
    {
        $path = mix($path, $manifestDirectory);
        if (!$supportHot) {
            $hotUrl = '//localhost:8080';
            if (starts_with($path, $hotUrl)) {
                $path = str_replace($hotUrl, '', $path);
            }
        }
        return $path;
    }

}

if (!function_exists('rest_client')) {

    /**
     * @param null $service_name
     * @param null $debug_mode
     * @return \Yeelight\Services\Rest\RestClient
     */
    function rest_client($service_name = null, $debug_mode = null)
    {
        return new \Yeelight\Services\Rest\RestClient($service_name, $debug_mode);
    }

}