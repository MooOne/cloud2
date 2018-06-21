<?php

namespace Yeelight\Http\Controllers\Backend;

use Yeelight\Http\Controllers\BaseController as BackendController;
use Yeelight\Services\Assets\Assets;
use Yeelight\Traits\BackendCurd;
use Yeelight\Traits\BackendExporter;
use Yeelight\Traits\BackendPagination;

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
