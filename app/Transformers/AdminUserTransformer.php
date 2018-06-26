<?php

namespace Yeelight\Transformers;

use Yeelight\Models\AdminUser;

/**
 * Class AdminUserTransformer
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
class AdminUserTransformer extends BaseTransformer
{
    /**
     * Transform the AdminUser entity.
     *
     * @param AdminUser $model
     *
     * @return array
     */
    public function transform(AdminUser $model)
    {
        return [
            'id'                => (int) $model->id,
            'username'          => (string) $model->username,
            'name'              => (string) $model->name,
            'avatar'            => (string) $model->getYeelightImageUrl(),
            'yeelight_image_id' => (int) $model->yeelight_image_id,
            'password'          => (string) $model->password,
            'remember_token'    => (string) $model->remember_token,
            'roles'             => (array) $model->roles,
            'role_ids'          => (array) $model->roles->pluck($model->getKeyName())->toArray(),
            'roles_str'         => (string) $this->getRolesAttr($model),
            'permissions'       => (array) $model->permissions,
            'permission_ids'    => (array) $model->permissions->pluck($model->getKeyName())->toArray(),
            'permissions_str'   => (string) $this->getPermissionsAttr($model),
            'created_at'        => (string) $model->created_at,
            'updated_at'        => (string) $model->updated_at,
        ];
    }

    public function getRolesAttr(AdminUser $model)
    {
        $roles = "<div style='margin-bottom: 5px;'>";
        $roles .= collect($model->roles)->map(function ($role, $index) {
            $br = $index && $index % 3 == 0 ? '</div><div style=\'margin-bottom: 5px;\'>' : '';

            return "<span class='label label-success'>{$role->name}</span>{$br}";
        })->implode('&nbsp;');
        $roles .= '</div>';

        return $roles;
    }

    public function getPermissionsAttr(AdminUser $model)
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
