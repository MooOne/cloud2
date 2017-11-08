<?php
namespace Yeelight\Presenters;

use Yeelight\Transformers\TeamTransformer;

/**
 * Class TeamPresenter
 *
 * @package namespace Yeelight\Presenters;
 */
class TeamPresenter extends BasePresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TeamTransformer();
    }
}
