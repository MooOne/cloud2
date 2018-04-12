<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminUserPermissionTransformer;

/**
 * Class AdminUserPermissionPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminUserPermissionPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminUserPermissionTransformer();
    }
}
