<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminRole;

/**
 * Class AdminRoleTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminRoleTransformer extends BaseTransformer
{

    /**
     * Transform the AdminRole entity
     * @param AdminRole $model
     *
     * @return array
     */
    public function transform(AdminRole $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
