<?php
namespace Yeelight\Repositories\Eloquent;

use Yeelight\Base\Repositories\Eloquent\Repository;
use Yeelight\Presenters\Presenter;
use Yeelight\Repositories\Interfaces\BaseRepositoryInterface;
use Prettus\Repository\Events\RepositoryEntityDeleted;

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
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $this->model = $this->model->whereIn($this->model->getKeyName(), $ids);

        $deleted = $this->model->delete();

        event(new RepositoryEntityDeleted($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        return $deleted;
    }

    /**
     * Chunk the results of the query.
     *
     * @param callable $callback
     * @param int $count
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        $this->applyCriteria();
        $this->applyScope();

        $lists = $this->model->chunk($count, $callback);

        $this->resetModel();

        return $lists;
    }
}