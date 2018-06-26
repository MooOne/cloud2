<?php

namespace Yeelight\Transformers;

use Yeelight\Models\AdminRole;

/**
 * Class AdminRoleTransformer
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
class AdminRoleTransformer extends BaseTransformer
{
    /**
     * Transform the AdminRole entity.
     *
     * @param AdminRole $model
     *
     * @return array
     */
    public function transform(AdminRole $model)
    {
        return [
            'id'                => (int) $model->id,
            'name'              => (string) $model->name,
            'slug'              => (string) $model->slug,
            'permissions'       => (array) $model->permissions,
            'permission_ids'    => (array) $model->permissions->pluck($model->getKeyName())->toArray(),
            'permissions_str'   => (string) $this->getPermissionsAttr($model),
            'created_at'        => (string) $model->created_at,
            'updated_at'        => (string) $model->updated_at,
        ];
    }

    public function getPermissionsAttr(AdminRole $model)
    {
        $permissions = "<div style='margin-bottom: 5px;'>";
        $permissions .= collect($model->permissions)->map(function ($permission, $index) {
            $br = $index && $index % 3 == 0 ? '</div><div style=\'margin-bottom: 5px;\'>' : '';

            return "<span class='label label-success'>{$permission->name}</span>{$br}";
        })->implode('&nbsp;');
        $permissions .= '</div>';

        return $permissions;
    }
}
