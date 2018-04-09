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
}