<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\UserTransformer;

/**
 * Class UserPresenter.
 */
class UserPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
