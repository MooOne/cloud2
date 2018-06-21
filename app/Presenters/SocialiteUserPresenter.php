<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\SocialiteUserTransformer;

/**
 * Class SocialiteUserPresenter.
 */
class SocialiteUserPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SocialiteUserTransformer();
    }
}
