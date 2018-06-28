<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-11
 * Time: 下午1:12.
 */

namespace Yeelight\Traits;

use Illuminate\Support\Facades\Input;

/**
 * Trait BackendCurd
 *
 * @category Yeelight
 *
 * @package Yeelight\Traits
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
trait BackendCurd
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Get RedirectResponse after store.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectAfterStore()
    {
        backend_toastr(trans('backend.save_succeeded'));

        $url = Input::get('_previous_') ?: get_resource(0);

        return redirect($url);
    }

    /**
     * Get RedirectResponse after update.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectAfterUpdate()
    {
        backend_toastr(trans('backend.update_succeeded'));

        $url = Input::get('_previous_') ?: get_resource(-1);

        return redirect($url);
    }
}
