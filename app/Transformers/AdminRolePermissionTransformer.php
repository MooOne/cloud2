<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminRolePermission;

/**
 * Class AdminRolePermissionTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminRolePermissionTransformer extends BaseTransformer
{

    /**
     * Transform the AdminRolePermission entity
     * @param AdminRolePermission $model
     *
     * @return array
     */
    public function transform(AdminRolePermission $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
