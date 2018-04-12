<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminRoleMenuTransformer;

/**
 * Class AdminRoleMenuPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminRoleMenuPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminRoleMenuTransformer();
    }
}
