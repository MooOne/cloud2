<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminRoleTransformer;

/**
 * Class AdminRolePresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminRolePresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminRoleTransformer();
    }
}
