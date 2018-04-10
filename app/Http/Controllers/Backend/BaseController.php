<?php
namespace Yeelight\Http\Controllers\Backend;

use Yeelight\Services\Assets\Assets;
use Yeelight\Http\Controllers\BaseController as BackendController;
use Yeelight\Traits\BackendExporter;
use Yeelight\Traits\BackendPagination;

abstract class BaseController extends BackendController
{
    use BackendPagination, BackendExporter;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(',', $id);
        $deleted = $this->repository->deleteIn($ids);

        if ($deleted) {
            return response()->json([
                'status'  => true,
                'message' => trans('backend.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('backend.delete_failed'),
            ]);
        }
    }
}
