<?php
namespace Yeelight\Transformers;

use Yeelight\Models\Role;

/**
 * Class RoleTransformer
 * @package namespace Yeelight\Transformers;
 */
class RoleTransformer extends BaseTransformer
{

    /**
     * Transform the Role entity
     * @param Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
