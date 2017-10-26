<?php
namespace Yeelight\Repositories\Interfaces;

use Yeelight\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace Yeelight\Repositories\Interfaces;
 */
interface UserRepository extends BaseRepositoryInterface
{
    /**
     * @param array|Collection $userIds
     * @return $this
     */
    public function byUserIds($userIds);
}
