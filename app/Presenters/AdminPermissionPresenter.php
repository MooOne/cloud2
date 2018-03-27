<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminPermissionTransformer;

/**
 * Class AdminPermissionPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminPermissionPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminPermissionTransformer();
    }
}
