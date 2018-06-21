<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminOperationLogTransformer;

/**
 * Class AdminOperationLogPresenter.
 */
class AdminOperationLogPresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminOperationLogTransformer();
    }
}
