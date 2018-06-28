<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Base\Repositories\Eloquent\Repository;
use Yeelight\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Class BaseRepository
 *
 * @category Yeelight
 *
 * @package Yeelight\Repositories\Eloquent
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class BaseRepository extends Repository implements BaseRepositoryInterface
{
    /**
     * Delete multiple entities by $ids.
     *
     * @param array $ids
     *
     * @return int
     */
    public function deleteIn(array $ids)
    {
        $deleted = false;
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $deleted = $this->delete($id);
            }
        }

        return $deleted;
    }

    /**
     * Chunk the results of the query.
     *
     * @param callable $callback
     * @param int      $count
     *
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        $this->applyCriteria();
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $lists = $this->model->chunk($count, $callback);

        $this->skipPresenter($temporarySkipPresenter);

        $this->resetModel();

        return $lists;
    }
}
