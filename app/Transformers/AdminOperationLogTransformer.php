<?php
namespace Yeelight\Transformers;

use Yeelight\Models\AdminOperationLog;

/**
 * Class AdminOperationLogTransformer
 * @package namespace Yeelight\Transformers;
 */
class AdminOperationLogTransformer extends BaseTransformer
{

    /**
     * Transform the AdminOperationLog entity
     * @param AdminOperationLog $model
     *
     * @return array
     */
    public function transform(AdminOperationLog $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => (string) $model->created_at,
            'updated_at' => (string) $model->updated_at
        ];
    }
}
