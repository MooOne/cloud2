<?php

namespace Yeelight\Repositories\Interfaces;

/**
 * Interface UserRepository.
 */
interface UserRepository extends BaseRepositoryInterface
{
    /**
     * @param array|Collection $userIds
     *
     * @return $this
     */
    public function byUserIds($userIds);
}
