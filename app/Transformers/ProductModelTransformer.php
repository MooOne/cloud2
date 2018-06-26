<?php

namespace Yeelight\Transformers;

use Yeelight\Models\ProductModel;

/**
 * Class ProductModelTransformer
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
class ProductModelTransformer extends BaseTransformer
{
    /**
     * Transform the ProductModel entity.
     *
     * @param ProductModel $model
     *
     * @return array
     */
    public function transform(ProductModel $model)
    {
        return [
            'product_model_id' => (int) $model->product_model_id,

            'title'      => (string) $model->title,
            'model_name' => (string) $model->model_name,
            'code'       => (string) $model->code,
            'status'     => (int) $model->status,

            'created_by' => (string) $model->created_by,
            'created_at' => (string) $model->created_at,
            'created_ip' => (string) $model->created_ip,
            'updated_by' => (string) $model->updated_by,
            'updated_at' => (string) $model->updated_at,
            'updated_ip' => (string) $model->updated_ip,
        ];
    }
}
