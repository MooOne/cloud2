<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminPermission;

/**
 * Class AdminPermissionTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminPermissionTransformer extends BaseTransformer
{

    /**
     * Transform the AdminPermission entity
     * @param AdminPermission $model
     *
     * @return array
     */
    public function transform(AdminPermission $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
