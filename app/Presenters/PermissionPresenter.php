<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\PermissionTransformer;

/**
 * Class PermissionPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class PermissionPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PermissionTransformer();
    }
}
