<?php

namespace Yeelight\Base\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Yeelight\Base\Presenters\Presenter;
use Yeelight\Base\Repositories\Interfaces\RepositoryInterface;
use Yeelight\Repositories\Criteria\AuthUserCriteria;

/**
 * Class Repository
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Repositories\Eloquent
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
abstract class Repository extends BaseRepository implements RepositoryInterface
{
    /**
     * Is Searchable Force And Where
     *
     * @var bool
     */
    protected $isSearchableForceAndWhere = false;

    /**
     * Relate Model
     *
     * @var Model
     */
    protected $relateModel;

    /**
     * Relation
     *
     * @var Relation
     */
    protected $relation;

    /**
     * ByAuthUser
     *
     * @return $this|RepositoryInterface
     * @throws RepositoryException
     */
    public function byAuthUser()
    {
        $this->pushCriteria(new AuthUserCriteria());

        return $this;
    }

    /**
     * Get auth UserId
     *
     * @return mixed
     */
    public function authUserId()
    {
        return current_auth_user()->user_id;
    }

    /**
     * Validate Creater
     *
     * @param array $attributes attributes
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     *
     * @return mixed
     */
    public function validateCreate(array $attributes)
    {
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
    }

    /**
     * Validate Updater
     *
     * @param array $attributes attributes
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     *
     * @return mixed
     */
    public function validateUpdate(array $attributes)
    {
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }
    }

    /**
     * SetValidator
     *
     * @param ValidatorInterface $validator validator
     *
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Present
     *
     * @param Object $results results
     *
     * @return mixed
     */
    public function present($results)
    {
        return $this->parserResult($results);
    }

    /**
     * SetRelateModel
     *
     * @param Model $relateModel relateModel
     *
     * @return $this
     * @throws RepositoryException
     */
    public function setRelateModel(Model $relateModel)
    {
        $this->relateModel = $relateModel;
        if ($relateModel) {
            $this->makeModel();
        }

        return $this;
    }

    /**
     * Relation
     *
     * @return \Prettus\Repository\Contracts\PresenterInterface
     */
    public function relation()
    {
    }

    /**
     * MakeModel
     *
     * @return Model|Relation|mixed|void
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->relateModel ? $this->relation() : $this->app->make($this->model());

        if (!($model instanceof Model || $model instanceof Relation)) {
            throw new RepositoryException('Class '.get_class($model).' must be an instance of Illuminate\\Database\\Eloquent\\Model');
        }

        return $this->model = $model;
    }

    /**
     * Retrieve data array for populate field select.
     *
     * @param string $column $column
     * @param string|null $key $key
     *
     * @return \Illuminate\Support\Collection|array
     * @throws RepositoryException
     */
    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        $this->applyScope();

        $lists = $this->model->lists($column, $key);

        $this->resetModel();

        return $lists;
    }

    /**
     * Retrieve all data of repository.
     *
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function all($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($this->model instanceof \Illuminate\Database\Eloquent\Builder
            || $this->model instanceof \Illuminate\Database\Eloquent\Relations\Relation
        ) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * Add a basic where clause to the model.
     *
     * @param string|array|\Closure $column $column
     * @param mixed $value $value
     *
     * @return $this
     */
    protected function modelWhere($column, $value = null)
    {
        $this->model = $this->model->where($column, $value);

        return $this;
    }

    /**
     * GetPresenter
     *
     * @return \Prettus\Repository\Contracts\PresenterInterface
     */
    public function getPresenter()
    {
        return $this->presenter;
    }

    /**
     * SetPresenterMeta
     *
     * @param array $meta $meta
     *
     * @return mixed
     */
    public function setPresenterMeta(array $meta)
    {
        if ($this->presenter instanceof Presenter) {
            $this->presenter->setMeta($meta);
        }
    }

    /**
     * GetIsSearchableForceAndWhere
     *
     * @return bool
     */
    public function getIsSearchableForceAndWhere()
    {
        return $this->isSearchableForceAndWhere;
    }

    /**
     * Find data by where conditions.
     *
     * @param array $where $where
     *
     * @return $this
     */
    public function where(array $where)
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);

        return $this;
    }

    /**
     * Retrieve first data of repository with fail if not found.
     *
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function firstOrFail($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->firstOrFail($columns);

        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * Where first.
     *
     * @param array $where where
     * @param array $columns columns
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function whereFirst(array $where, $columns = ['*'])
    {
        return $this->where($where)->firstOrFail($columns = ['*']);
    }

    /**
     * Use Model for custom usages.
     *
     * @param callable $callback callback
     *
     * @return $this
     */
    public function useModel(callable $callback)
    {
        $this->model = $callback($this->model);

        return $this;
    }

    /**
     * Remove all or passed registered global scopes.
     *
     * @param array|null $scopes scopes
     *
     * @return $this
     */
    public function withoutGlobalScopes(array $scopes = null)
    {
        $this->model = $this->model->withoutGlobalScopes($scopes);

        return $this;
    }
}
