<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\UserTransformer;

/**
 * Class UserPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class UserPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
