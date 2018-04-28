<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\SocialiteUserTransformer;

/**
 * Class SocialiteUserPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class SocialiteUserPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SocialiteUserTransformer();
    }
}
