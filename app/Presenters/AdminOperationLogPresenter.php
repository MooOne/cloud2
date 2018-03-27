<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminOperationLogTransformer;

/**
 * Class AdminOperationLogPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class AdminOperationLogPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminOperationLogTransformer();
    }
}
