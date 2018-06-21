<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminMenuTransformer;

/**
 * Class AdminMenuPresenter.
 */
class AdminMenuPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminMenuTransformer();
    }
}
