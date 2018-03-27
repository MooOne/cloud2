<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminMenu;

/**
 * Class AdminMenuTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminMenuTransformer extends BaseTransformer
{

    /**
     * Transform the AdminMenu entity
     * @param AdminMenu $model
     *
     * @return array
     */
    public function transform(AdminMenu $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
