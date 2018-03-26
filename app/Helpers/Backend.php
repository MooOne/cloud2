<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-3-23
 * Time: 上午9:21
 */

if (!function_exists('backend_path')) {

    /**
     * Get backend path.
     *
     * @param string $path
     *
     * @return string
     */
    function backend_path($path = '')
    {
        return ucfirst(config('yeelight.backend.directory')).($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('backend_url')) {
    /**
     * Get backend url.
     *
     * @param string $path
     *
     * @return string
     */
    function backend_url($path = '')
    {
        if (\Illuminate\Support\Facades\URL::isValidUrl($path)) {
            return $path;
        }

        return url(backend_base_path($path));
    }
}

if (!function_exists('backend_base_path')) {
    /**
     * Get backend url.
     *
     * @param string $path
     *
     * @return string
     */
    function backend_base_path($path = '')
    {
        $prefix = '/'.trim(config('yeelight.backend.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        return $prefix.'/'.trim($path, '/');
    }
}

if (!function_exists('backend_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     *
     * @return string
     */
    function backend_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new \Illuminate\Support\MessageBag(get_defined_vars());

        \Illuminate\Support\Facades\Session::flash('toastr', $toastr);
    }
}

if (!function_exists('backend_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function backend_asset($path)
    {
        return asset($path, config('yeelight.backend.secure'));
    }
}
