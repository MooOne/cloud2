<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminRolePermissionTransformer;

/**
 * Class AdminRolePermissionPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminRolePermissionPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminRolePermissionTransformer();
    }
}
