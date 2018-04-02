<?php
namespace Yeelight\Http\Controllers\Backend;

use Yeelight\Base\Http\Controllers\Controller;
use Yeelight\Models\Foundation\User;
use Yeelight\Services\Assets\Assets;
use Yeelight\Http\Controllers\BaseController as BackendController;

abstract class BaseController extends BackendController
{
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
        return Assets::js($script);
    }
}
