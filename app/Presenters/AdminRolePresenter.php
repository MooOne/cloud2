<?php

namespace Yeelight\Presenters;

use Yeelight\Transformers\AdminRoleTransformer;

/**
 * Class AdminRolePresenter.
 *
 * @category Yeelight
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class AdminRolePresenter extends BasePresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminRoleTransformer();
    }
}
