<?php

namespace Yeelight\Transformers;

use Yeelight\Models\AdminOperationLog;

/**
 * Class AdminOperationLogTransformer
 *
 * @category Yeelight
 *
 * @package Yeelight\Transformers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminOperationLogTransformer extends BaseTransformer
{
    /**
     * Transform the AdminOperationLog entity.
     *
     * @param AdminOperationLog $model
     *
     * @return array
     */
    public function transform(AdminOperationLog $model)
    {
        return [
            'id'           => (int) $model->id,
            'user_id'      => (int) $model->user_id,
            'user_name'    => (string) $model->user->name,
            'path'         => (string) $model->path,
            'method'       => (string) $model->method,
            'method_color' => (string) isset(AdminOperationLog::$methodColors[$model->method]) ? AdminOperationLog::$methodColors[$model->method] : '',
            'ip'           => (string) $model->ip,
            'input'        => (string) $model->input,
            'created_at'   => (string) $model->created_at,
            'updated_at'   => (string) $model->updated_at,
        ];
    }
}
