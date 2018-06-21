<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Models\ProductModel;
use Yeelight\Presenters\ProductModelPresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\productModelRepository;
use Yeelight\Validators\ProductModelValidator;

/**
 * Class ProductModelRepositoryEloquent.
 */
class ProductModelRepositoryEloquent extends BaseRepository implements ProductModelRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'      => 'like',
        'model_name' => 'like',
        'code'       => 'like',
        'status',
    ];

    /**
     * @var bool
     */
    protected $isSearchableForceAndWhere = true;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return ProductModel::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return ProductModelValidator::class;
    }

    /**
     * Specify Presenter class name.
     *
     * @return mixed
     */
    public function presenter()
    {
        return ProductModelPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
