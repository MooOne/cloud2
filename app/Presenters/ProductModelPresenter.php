<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\ProductModelTransformer;

/**
 * Class ProductModelPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class ProductModelPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductModelTransformer();
    }
}
