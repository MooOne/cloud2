<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminRoleUserTransformer;

/**
 * Class AdminRoleUserPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminRoleUserPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminRoleUserTransformer();
    }
}
