<?php

namespace Yeelight\Events\User;

use Illuminate\Queue\SerializesModels;
use Yeelight\Models\Foundation\User;

/**
 * Class UserLoggedInEvent
 *
 * @category Yeelight
 *
 * @package Yeelight\Events\User
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class UserLoggedInEvent
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user User
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
