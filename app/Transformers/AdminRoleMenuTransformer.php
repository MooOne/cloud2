<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminRoleMenu;

/**
 * Class AdminRoleMenuTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminRoleMenuTransformer extends BaseTransformer
{

    /**
     * Transform the AdminRoleMenu entity
     * @param AdminRoleMenu $model
     *
     * @return array
     */
    public function transform(AdminRoleMenu $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
