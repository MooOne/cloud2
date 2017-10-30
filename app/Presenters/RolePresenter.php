<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\RoleTransformer;

/**
 * Class RolePresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class RolePresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoleTransformer();
    }
}
