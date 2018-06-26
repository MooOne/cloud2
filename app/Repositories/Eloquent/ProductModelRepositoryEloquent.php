<?php

namespace Yeelight\Repositories\Eloquent;

use Yeelight\Models\ProductModel;
use Yeelight\Presenters\ProductModelPresenter;
use Yeelight\Repositories\Criteria\RequestCriteria;
use Yeelight\Repositories\Interfaces\productModelRepository;
use Yeelight\Validators\ProductModelValidator;

/**
 * Class ProductModelRepositoryEloquent
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
class ProductModelRepositoryEloquent
    extends BaseRepository
    implements ProductModelRepository
{
    /**
     * $fieldSearchable
     *
     * @var array
     */
    protected $fieldSearchable = [
        'title'      => 'like',
        'model_name' => 'like',
        'code'       => 'like',
        'status',
    ];

    /**
     * $isSearchableForceAndWhere
     *
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
