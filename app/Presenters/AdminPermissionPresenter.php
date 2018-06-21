<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminPermissionTransformer;

/**
 * Class AdminPermissionPresenter.
 */
class AdminPermissionPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminPermissionTransformer();
    }
}
