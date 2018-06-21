<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-3-23
 * Time: 上午9:21.
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

if (!function_exists('backend_auth_path')) {
    /**
     * Get backend url.
     *
     * @param string $path
     *
     * @return string
     */
    function backend_auth_path($path = '')
    {
        $prefix = '/'.trim(config('yeelight.backend.auth_route.prefix'), '/');

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
        return asset('assets/'.$path, config('yeelight.backend.secure'));
    }
}

if (!function_exists('backend_user')) {

    /**
     * Get current backend login user.
     *
     * @return mixed
     */
    function backend_user()
    {
        return Auth::guard(config('yeelight.backend.route.prefix'))->user();
    }
}

if (!function_exists('backend_title')) {

    /**
     * Get backend title.
     *
     * @return Config
     */
    function backend_title()
    {
        return config('yeelight.backend.title');
    }
}

if (!function_exists('backend_export_url')) {

    /**
     * Get the export url.
     *
     * @param int  $scope
     * @param null $args
     *
     * @return string
     */
    function backend_export_url($scope = -1, $args = null)
    {
        return \Yeelight\Services\Exporters\Exporter::exportUrl($scope, $args);
    }
}

if (!function_exists('column_sorter')) {
    /**
     * Create the column sorter.
     *
     * @param $column_name
     *
     * @return string|void
     */
    function column_sorter($column_name)
    {
        $icon = 'fa-sort';
        $type = 'desc';
        $isSorted = false;

        $orderBy = app('request')->get(config('repository.criteria.params.orderBy', 'orderBy'), null);
        $sortedBy = app('request')->get(config('repository.criteria.params.sortedBy', 'sortedBy'), null);

        if (!empty($orderBy)) {
            $isSorted = isset($orderBy) && $orderBy == $column_name;
        }

        if ($isSorted) {
            $type = $sortedBy == 'desc' ? 'asc' : 'desc';
            $icon .= "-amount-{$sortedBy}";
        }

        $query = app('request')->all();
        $query = array_merge($query, [
            config('repository.criteria.params.orderBy')  => $column_name,
            config('repository.criteria.params.sortedBy') => $type,
        ]);

        $url = URL::current().'?'.http_build_query($query);

        return "<a class=\"fa fa-fw $icon\" href=\"$url\"></a>";
    }
}

if (!function_exists('get_resource')) {
    /**
     * get resource uri.
     *
     * @param null   $slice
     * @param string $mode
     *
     * @return string
     */
    function get_resource($slice = null, $mode = '')
    {
        $segments = explode('/', trim(app('request')->getUri(), '/'));
        if ($mode == 'create') {
            $segments = array_slice($segments, 0, -1);
        }
        if ($slice !== null) {
            if ($slice != 0) {
                $segments = array_slice($segments, 0, $slice);
            }
        }

        if (strpos(end($segments), '?')) {
            $segments[count($segments) - 1] = substr(end($segments), 0, strpos(end($segments), '?'));
        }

        return implode('/', $segments);
    }
}

if (!function_exists('url_without_filters')) {
    /**
     * Get url without filter queryString.
     *
     * @param $columns
     *
     * @return string
     */
    function url_without_filters($columns)
    {
        /** @var \Illuminate\Http\Request $request * */
        $request = Request::instance();

        $query = $request->query();
        array_forget($query, array_keys($columns));

        $question = $request->getBaseUrl().$request->getPathInfo() == '/' ? '/?' : '?';

        return count($request->query()) > 0
            ? $request->url().$question.http_build_query($query)
            : $request->fullUrl();
    }
}
