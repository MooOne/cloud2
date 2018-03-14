<?php
namespace Yeelight\Transformers;

use Yeelight\Models\Permission;

/**
 * Class PermissionTransformer
 * @package namespace Yeelight\Transformers;
 */
class PermissionTransformer extends BaseTransformer
{

    /**
     * Transform the Permission entity
     * @param Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id' => (int) $model->id,

            'name' => (string) $model->created_at,

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
