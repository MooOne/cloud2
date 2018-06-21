<?php

namespace Yeelight\Base\Presenters;

use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Presenter\FractalPresenter;

abstract class Presenter extends FractalPresenter
{
    protected $meta = [];

    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function present($data)
    {
        if (!class_exists('League\Fractal\Manager')) {
            throw new Exception(trans('repository::packages.league_fractal_required'));
        }

        if ($data instanceof Collection) {
            $this->resource = $this->transformCollection($data);
        } elseif ($data instanceof AbstractPaginator) {
            $this->resource = $this->transformPaginator($data);
        } else {
            $this->resource = $this->transformItem($data);
        }

        // set meta
        $this->resource->setMeta($this->meta);

        return $this->fractal->createData($this->resource)->toArray();
    }

    /**
     * @param array $meta
     */
    public function setMeta(array $meta)
    {
        $this->meta = $meta;
    }
}
