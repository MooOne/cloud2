<?php

namespace Yeelight\Transformers;

use Yeelight\Models\AdminMenu;

/**
 * Class AdminMenuTransformer
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
class AdminMenuTransformer extends BaseTransformer
{
    /**
     * Transform the AdminMenu entity.
     *
     * @param AdminMenu $model
     *
     * @return array
     */
    public function transform(AdminMenu $model)
    {
        return [
            'id'                        => (int) $model->id,
            'parent_id'                 => (int) $model->parent_id,
            'order'                     => (int) $model->order,
            'title'                     => (string) $model->title,
            'icon'                      => (string) $model->icon,
            'uri'                       => (string) $model->uri,
            'roles'                     => (array) $model->roles,
            'role_ids'                  => (array) $model->roles->pluck($model->getKeyName())->toArray(),
            'roles_str'                 => (string) $this->getRolesAttr($model),
            'created_at'                => (string) $model->created_at,
            'updated_at'                => (string) $model->updated_at,
        ];
    }

    public function getRolesAttr(AdminMenu $model)
    {
        $roles = "<div style='margin-bottom: 5px;'>";
        $roles .= collect($model->roles)->map(function ($role, $index) {
            $br = $index && $index % 3 == 0 ? '</div><div style=\'margin-bottom: 5px;\'>' : '';

            return "<span class='label label-success'>{$role->name}</span>{$br}";
        })->implode('&nbsp;');
        $roles .= '</div>';

        return $roles;
    }
}
