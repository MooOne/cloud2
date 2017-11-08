<?php
namespace Yeelight\Transformers;

use Yeelight\Models\Menu;

/**
 * Class MenuTransformer
 * @package namespace Yeelight\Transformers;
 */
class MenuTransformer extends BaseTransformer
{

    /**
     * Transform the Menu entity
     * @param Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        return [
            'menu_id' => (int) $model->menu_id,
            'pid' => (int) $model->pid,
            'sort' => (int) $model->sort,
            'user_id' => (int) $model->user_id,
            'name' => (string) $model->name,
            'icon' => (string) $model->icon,
            'slug' => (string) $model->slug,
            'url' => (string) $model->url,
            'active' => (string) $model->active,
            'description' => (string) $model->description,
            'created_by' => (string) $model->created_by,
            'created_at' => (string) $model->created_at,
            'created_ip' => (string) $model->created_ip,
            'updated_by' => (string) $model->updated_by,
            'updated_at' => (string) $model->updated_at,
            'updated_ip' => (string) $model->updated_ip,
        ];
    }
}
