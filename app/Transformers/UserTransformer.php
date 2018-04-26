<?php
namespace Yeelight\Transformers;

use Yeelight\Models\User;

/**
 * Class UserTransformer
 * @package namespace Yeelight\Transformers;
 */
class UserTransformer extends BaseTransformer
{

    /**
     * Transform the User entity
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
