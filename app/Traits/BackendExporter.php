<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 下午2:12.
 */

namespace Yeelight\Traits;

use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Yeelight\Services\Exporters\Exporter;

/**
 * Trait BackendExporter
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
trait BackendExporter
{
    /**
     * @var bool
     */
    protected $useExporter = true;

    /**
     * Export driver.
     *
     * @var string
     */
    protected $exporter;

    /**
     * Setup grid exporter.
     *
     * @return void
     */
    public function setupExporter()
    {
        if ($scope = Input::get(Exporter::$queryName)) {
            if (!$this->useExporter) {
                // Failed, throw exception
                throw new NotAcceptableHttpException(trans('backend.export_forbidden'));
            }

            (new Exporter($this->repository))->resolve($this->exporter)->withScope($scope)->export();
        }
    }

    /**
     * Set exporter driver to export.
     *
     * @param $exporter
     *
     * @return $this
     */
    public function exporter($exporter)
    {
        $this->exporter = $exporter;

        return $this;
    }

    /**
     * Get the export url.
     *
     * @param int  $scope
     * @param null $args
     *
     * @return string
     */
    public function exportUrl($scope = 1, $args = null)
    {
        $input = array_merge(Input::all(), Exporter::formatExportQuery($scope, $args));

        return get_resource().'?'.http_build_query($input);
    }
}
