<?php
/**
 * Created by PhpStorm.
 * User: sheldon
 * Date: 18-4-10
 * Time: 上午11:33.
 */

namespace Yeelight\Services\Exporters;

use Yeelight\Repositories\Eloquent\BaseRepository as Repository;

/**
 * Class AbstractExporter
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
abstract class AbstractExporter implements ExporterInterface
{
    /**
     * @var \Yeelight\Repositories\Eloquent\BaseRepository
     */
    protected $repository;

    /**
     * Create a new exporter instance.
     *
     * @param $repository
     */
    public function __construct(Repository $repository = null)
    {
        if ($repository) {
            $this->setRepository($repository);
        }
    }

    /**
     * Set repository for exporter.
     *
     * @param Repository $repository
     *
     * @return $this
     */
    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Get table of grid.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->repository->makeModel()->getTable();
    }

    /**
     * Get data with export query.
     *
     * @return array
     */
    public function getData()
    {
        return $this->repository->all();
    }

    /**
     * @param callable $callback
     * @param int      $count
     *
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        return $this->repository->chunk($callback, $count);
    }

    /**
     * Export data with scope.
     *
     * @param string $scope
     *
     * @return $this
     */
    public function withScope($scope)
    {
        if ($scope == Exporter::SCOPE_ALL) {
            return $this;
        }

        list($scope, $args) = explode(':', $scope);

        if ($scope == Exporter::SCOPE_CURRENT_PAGE) {
            $this->repository->paginate();
        }

        if ($scope == Exporter::SCOPE_SELECTED_ROWS) {
            $selected = explode(',', $args);
            $this->repository->findWhereIn($this->repository->makeModel()->getKeyName(), $selected);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function export();
}
