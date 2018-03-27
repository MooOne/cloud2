<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminUser;

/**
 * Class AdminUserTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminUserTransformer extends BaseTransformer
{

    /**
     * Transform the AdminUser entity
     * @param AdminUser $model
     *
     * @return array
     */
    public function transform(AdminUser $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
