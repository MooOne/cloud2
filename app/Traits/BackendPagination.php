<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-3-27
 * Time: 下午4:12.
 */

namespace Yeelight\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

/**
 * Trait BackendPagination
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
trait BackendPagination
{
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator
     */
    protected $backendPagination = null;

    /**
     * Create a new RepositoryInterface instance.
     *
     * @param array $lists
     *
     * @return string
     */
    public function backendPagination($lists)
    {
        //Initialize work for BackendPagination.
        $this->backendPagination = new LengthAwarePaginator(
            $lists['data'],
            $lists['meta']['pagination']['total'],
            $lists['meta']['pagination']['per_page'],
            $lists['meta']['pagination']['current_page'],
            [
                'path'     => Paginator::resolveCurrentPath(), //注释2
                'pageName' => config('yeelight.backend.pagination.pageName'),
            ]
        );

        $this->backendPagination->appends(Input::all());

        return $this->paginationRanger().
            $this->paginationLinks();
    }

    /**
     * Get Pagination links.
     *
     * @return string
     */
    protected function paginationLinks()
    {
        return $this->backendPagination->render('backend.pagination');
    }

    /**
     * Get range infomation of BackendPagination.
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function paginationRanger()
    {
        $parameters = [
            'first' => $this->backendPagination->firstItem(),
            'last'  => $this->backendPagination->lastItem(),
            'total' => $this->backendPagination->total(),
        ];

        $parameters = collect($parameters)->flatMap(function ($parameter, $key) {
            return [$key => "<b>$parameter</b>"];
        });

        return trans('backend.pagination.range', $parameters->all());
    }
}
