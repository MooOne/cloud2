<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 上午11:40.
 */

namespace Yeelight\Services\Exporters;

use Illuminate\Support\Facades\Input;
use Yeelight\Repositories\Eloquent\BaseRepository as Repository;

/**
 * Class Exporter
 *
 * @category Yeelight
 *
 * @package Yeelight\Services\Exporters
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class Exporter
{
    /**
     * Export scope constants.
     */
    const SCOPE_ALL = 'all';
    const SCOPE_CURRENT_PAGE = 'page';
    const SCOPE_SELECTED_ROWS = 'selected';

    /**
     * @var \Yeelight\Repositories\Eloquent\BaseRepository
     */
    protected $repository;

    /**
     * Available exporter drivers.
     *
     * @var array
     */
    protected static $drivers = [];

    /**
     * Export query name.
     *
     * @var string
     */
    public static $queryName = '_export_';

    /**
     * Create a new Exporter instance.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Set export query name.
     *
     * @param $name
     */
    public static function setQueryName($name)
    {
        static::$queryName = $name;
    }

    /**
     * Extends new exporter driver.
     *
     * @param $driver
     * @param $extend
     */
    public static function extend($driver, $extend)
    {
        static::$drivers[$driver] = $extend;
    }

    /**
     * Resolve export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    public function resolve($driver)
    {
        if ($driver instanceof AbstractExporter) {
            return $driver->setRepository($this->repository);
        }

        return $this->getExporter($driver);
    }

    /**
     * Get export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    protected function getExporter($driver)
    {
        if (!array_key_exists($driver, static::$drivers)) {
            return $this->getDefaultExporter();
        }

        return new static::$drivers[$driver]($this->repository);
    }

    /**
     * Get default exporter.
     *
     * @return CsvExporter
     */
    public function getDefaultExporter()
    {
        return new ExcelExporter($this->repository);
    }

    /**
     * Format query for export url.
     *
     * @param int|string $scope
     * @param null       $args
     *
     * @return array
     */
    public static function formatExportQuery($scope = '', $args = null)
    {
        $query = '';

        if ($scope == static::SCOPE_ALL) {
            $query = 'all';
        }

        if ($scope == static::SCOPE_CURRENT_PAGE) {
            $query = "page:$args";
        }

        if ($scope == static::SCOPE_SELECTED_ROWS) {
            $query = "selected:$args";
        }

        return [static::$queryName => $query];
    }

    /**
     * Get the export url.
     *
     * @param int  $scope
     * @param null $args
     *
     * @return string
     */
    public static function exportUrl($scope = 1, $args = null)
    {
        $input = array_merge(Input::all(), self::formatExportQuery($scope, $args));

        return get_resource().'?'.http_build_query($input);
    }
}
