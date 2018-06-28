<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\SocialiteUserTransformer;

/**
 * Class SocialiteUserPresenter
 *
 * @category Yeelight
 *
 * @package Yeelight\Presenters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
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
