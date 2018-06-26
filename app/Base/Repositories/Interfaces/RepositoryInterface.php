<?php

namespace Yeelight\Base\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface as BaseRepositoryInterface;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Interface RepositoryInterface
 *
 * @category Yeelight
 *
 * @package Yeelight\Base\Repositories\Interfaces
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
interface RepositoryInterface extends BaseRepositoryInterface
{
    /**
     * ByAuthUser
     *
     * @return $this
     */
    public function byAuthUser();

    /**
     * AuthUserId
     *
     * @return mixed
     */
    public function authUserId();

    /**
     * ValidateCreate
     *
     * @param array $attributes attributes
     *
     * @return void
     */
    public function validateCreate(array $attributes);

    /**
     * ValidateUpdate
     *
     * @param array $attributes attributes
     *
     * @return void
     */
    public function validateUpdate(array $attributes);

    /**
     * SetValidator
     *
     * @param ValidatorInterface $validator validator
     *
     * @return $this
     */
    public function setValidator($validator);

    /**
     * Present
     *
     * @param Object $results results
     *
     * @return mixed
     */
    public function present($results);

    /**
     * SetRelateModel
     *
     * @param Model $targetModel targetModel
     *
     * @return $this
     * @throws RepositoryException
     */
    public function setRelateModel(Model $targetModel);

    /**
     * Relation
     *
     * @return \Prettus\Repository\Contracts\PresenterInterface
     */
    public function getPresenter();

    /**
     * SetPresenterMeta
     *
     * @param array $meta $meta
     *
     * @return mixed
     */
    public function setPresenterMeta(array $meta);

    /**
     * GetIsSearchableForceAndWhere
     *
     * @return bool
     */
    public function getIsSearchableForceAndWhere();

    /**
     * Find data by where conditions.
     *
     * @param array $where where
     *
     * @return $this
     */
    public function where(array $where);

    /**
     * Retrieve first data of repository with fail if not found.
     *
     * @param array $columns columns
     *
     * @return mixed
     */
    public function firstOrFail($columns = ['*']);

    /**
     * Where first.
     *
     * @param array $where where
     * @param array $columns columns
     *
     * @return mixed
     */
    public function whereFirst(array $where, $columns = ['*']);

    /**
     * Wrapper result data.
     *
     * @param mixed $result result
     *
     * @return mixed
     */
    public function parserResult($result);

    /**
     * Use Model for custom usages.
     *
     * @param callable $callback callback
     *
     * @return $this
     */
    public function useModel(callable $callback);

    /**
     * Remove all or passed registered global scopes.
     *
     * @param array|null $scopes scopes
     *
     * @return $this
     */
    public function withoutGlobalScopes(array $scopes = null);
}
