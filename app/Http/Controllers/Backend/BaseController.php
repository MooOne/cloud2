<?php

namespace Yeelight\Http\Controllers\Backend;

use Yeelight\Http\Controllers\BaseController as BackendController;
use Yeelight\Services\Assets\Assets;
use Yeelight\Traits\BackendCurd;
use Yeelight\Traits\BackendExporter;
use Yeelight\Traits\BackendPagination;

/**
 * Class BaseController
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Backend
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class BaseController extends BackendController
{
    use BackendPagination, BackendExporter, BackendCurd;

    /**
     * Add css or get all css.
     *
     * @param null $css
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function css($css = null)
    {
        return Assets::css($css);
    }

    /**
     * Add js or get all js.
     *
     * @param null $js
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function js($js = null)
    {
        return Assets::js($js);
    }

    /**
     * @param string $script
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function script($script = '')
    {
        return Assets::script($script);
    }
}
