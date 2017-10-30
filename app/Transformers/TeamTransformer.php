<?php
namespace Yeelight\Transformers;

use Yeelight\Models\Team;

/**
 * Class TeamTransformer
 * @package namespace Yeelight\Transformers;
 */
class TeamTransformer extends BaseTransformer
{

    /**
     * Transform the Team entity
     * @param Team $model
     *
     * @return array
     */
    public function transform(Team $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
