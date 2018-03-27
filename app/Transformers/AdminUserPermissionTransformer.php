<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminUserPermission;

/**
 * Class AdminUserPermissionTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminUserPermissionTransformer extends BaseTransformer
{

    /**
     * Transform the AdminUserPermission entity
     * @param AdminUserPermission $model
     *
     * @return array
     */
    public function transform(AdminUserPermission $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
