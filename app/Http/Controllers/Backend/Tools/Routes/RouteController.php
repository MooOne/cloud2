<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-19
 * Time: 上午10:25.
 */

namespace Yeelight\Http\Controllers\Backend\Tools\Routes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Yeelight\Http\Controllers\BaseController;

/**
 * Class RouteController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend\Tools\Routes
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class RouteController extends BaseController
{
    public function index()
    {
        $routes = $this->getModel()
            ->setRoutes($this->getRoutes())
            ->where('name', request('name'))
            ->where('uri', request('uri'))
            ->where('action', request('action'))
            ->get();
        $colors = [
            'GET'    => 'green',
            'HEAD'   => 'gray',
            'POST'   => 'blue',
            'PUT'    => 'yellow',
            'DELETE' => 'red',
            'PATCH'  => 'aqua',
            'OPTIONS'=> 'light-blue',
        ];

        $columns = [
            'method'     => 'Method',
            'uri'        => 'Uri',
            'name'       => 'Name',
            'action'     => 'Action',
            'middleware' => 'Middleware',
        ];

        $routes = collect($routes)->map(function ($item) use ($colors) {
            $data = [];

            $data['method'] = collect($item->method)->map(function ($method) use ($colors) {
                return "<span class=\"label bg-{$colors[$method]}\">$method</span>";
            })->implode('&nbsp;');
            $data['uri'] = preg_replace('/\{.+?\}/', '<code>$0</span>', $item->uri);
            $data['name'] = $item->name;
            $data['action'] = preg_replace('/\{.+?\}/', '<code>$0</span>', $item->action);
            $data['middleware'] = '<span class="badge bg-danger">'.$item->middleware.'</span>';

            return $data;
        });

        return view('backend.tools.routes.index', [
            'lists'   => $routes,
            'columns' => $columns,
            'query'   => request()->query(),
        ]);
    }

    protected function getModel()
    {
        return new class() extends Model {
            protected $routes;
            protected $where = [];

            public function setRoutes($routes)
            {
                $this->routes = $routes;

                return $this;
            }

            public function where($column, $condition)
            {
                if (trim($condition)) {
                    $this->where[$column] = trim($condition);
                }

                return $this;
            }

            public function orderBy()
            {
                return $this;
            }

            public function get()
            {
                $this->routes = collect($this->routes)->filter(function ($route) {
                    foreach ($this->where as $column => $condition) {
                        if (!Str::contains($route[$column], $condition)) {
                            return false;
                        }
                    }

                    return true;
                })->all();
                $instance = $this->newModelInstance();

                return $instance->newCollection(array_map(function ($item) use ($instance) {
                    return $instance->newFromBuilder($item);
                }, $this->routes));
            }
        };
    }

    public function getRoutes()
    {
        $routes = app('router')->getRoutes();
        $routes = collect($routes)->map(function ($route) {
            return $this->getRouteInformation($route);
        })->all();
        if ($sort = request('orderBy')) {
            $routes = $this->sortRoutes($sort, $routes);
        }

        return array_filter($routes);
    }

    /**
     * Get the route information for a given route.
     *
     * @param \Illuminate\Routing\Route $route
     *
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return [
            'host'       => $route->domain(),
            'method'     => $route->methods(),
            'uri'        => $route->uri(),
            'name'       => $route->getName(),
            'action'     => $route->getActionName(),
            'middleware' => $this->getRouteMiddleware($route),
        ];
    }

    /**
     * Sort the routes by a given element.
     *
     * @param string $sort
     * @param array  $routes
     *
     * @return array
     */
    protected function sortRoutes($sort, $routes)
    {
        $sortedBy = request('sortedBy');
        if ($sortedBy == 'desc') {
            array_multisort(array_column($routes, $sort), SORT_DESC, $routes);

            return $routes;
        } else {
            array_multisort(array_column($routes, $sort), SORT_ASC, $routes);

            return $routes;
        }
    }

    /**
     * Get before filters.
     *
     * @param \Illuminate\Routing\Route $route
     *
     * @return string
     */
    protected function getRouteMiddleware($route)
    {
        return collect($route->gatherMiddleware())->map(function ($middleware) {
            return $middleware instanceof \Closure ? 'Closure' : $middleware;
        });
    }
}
