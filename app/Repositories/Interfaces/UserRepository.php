<?php

namespace Yeelight\Repositories\Interfaces;

use Illuminate\Support\Collection;

/**
 * Interface UserRepository
 *
 * @category Yeelight
 *
 * @package Yeelight\Repositories\Interfaces
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
interface UserRepository extends BaseRepositoryInterface
{
    /**
     * @param array|Collection $userIds Collection
     *
     * @return $this
     */
    public function byUserIds($userIds);
}
