<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\ProductModelTransformer;

/**
 * Class ProductModelPresenter.
 *
 * @category Yeelight
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ProductModelPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductModelTransformer();
    }
}
