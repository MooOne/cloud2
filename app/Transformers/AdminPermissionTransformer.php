<?php

namespace Yeelight\Transformers;

use Illuminate\Support\Str;
use Yeelight\Models\AdminPermission;

/**
 * Class AdminPermissionTransformer
 *
 * @category Yeelight
 *
 * @package Yeelight\Transformers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminPermissionTransformer extends BaseTransformer
{
    /**
     * Transform the AdminPermission entity.
     *
     * @param AdminPermission $model
     *
     * @return array
     */
    public function transform(AdminPermission $model)
    {
        return [
            'id'                => (int) $model->id,
            'name'              => (string) $model->name,
            'slug'              => (string) $model->slug,
            'http_method'       => (array) $model->http_method,
            'http_method_str'   => (string) $this->getHttpMethodAttr($model),
            'http_path'         => (string) $model->http_path,
            'http_path_str'     => (string) $this->getHttpPathAttr($model),
            'created_at'        => (string) $model->created_at,
            'updated_at'        => (string) $model->updated_at,
        ];
    }

    public function getHttpPathAttr(AdminPermission $model)
    {
        return collect(explode("\r\n", $model->http_path))->map(function ($path) use ($model) {
            $method = $model->http_method ?: ['ANY'];

            if (Str::contains($path, ':')) {
                list($method, $path) = explode(':', $path);
                $method = explode(',', $method);
            }

            $method = collect($method)->map(function ($name) {
                return strtoupper($name);
            })->map(function ($name) {
                return "<span class='label label-primary'>{$name}</span>";
            })->implode('&nbsp;');

            $path = '/'.trim(config('yeelight.backend.route.prefix'), '/').$path;

            return "<div style='margin-bottom: 5px;'>$method<code>$path</code></div>";
        })->implode('');
    }

    public function getHttpMethodAttr(AdminPermission $model)
    {
        return collect($model->http_method)->map(function ($name) {
            return strtoupper($name);
        })->map(function ($name) {
            return "<span class='label label-primary'>{$name}</span>";
        })->implode('&nbsp;');
    }
}
