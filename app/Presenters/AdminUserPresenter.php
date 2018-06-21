<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminUserTransformer;

/**
 * Class AdminUserPresenter.
 */
class AdminUserPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminUserTransformer();
    }
}
