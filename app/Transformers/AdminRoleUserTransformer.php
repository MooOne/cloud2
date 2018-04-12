<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminRoleUser;

/**
 * Class AdminRoleUserTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminRoleUserTransformer extends BaseTransformer
{

    /**
     * Transform the AdminRoleUser entity
     * @param AdminRoleUser $model
     *
     * @return array
     */
    public function transform(AdminRoleUser $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
