<?php

namespace Yeelight\Listeners\User;

use Yeelight\Events\User\UserLoggedInEvent;
use Yeelight\Events\User\UserRegisteredEvent;

/**
 * Class UserEventListener
 *
 * @category Yeelight
 *
 * @package Yeelight\Listeners\User
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class UserEventListener
{
    public function __construct()
    {
    }

    /**
     * Handle user login events.
     *
     * @param UserLoggedInEvent $event UserLoggedInEvent
     */
    public function onUserLogin(UserLoggedInEvent $event)
    {
    }

    /**
     * Handle user registered events.
     *
     * @param UserRegisteredEvent $event UserRegisteredEvent
     */
    public function onUserRegistered(UserRegisteredEvent $event)
    {
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events Dispatcher
     */
    public function subscribe($events)
    {
        $events->listen(
            UserLoggedInEvent::class,
            'Yeelight\Listeners\User\UserEventListener@onUserLogin'
        );

        $events->listen(
            UserRegisteredEvent::class,
            'Yeelight\Listeners\User\UserEventListener@onUserRegistered'
        );

        /*$events->listen(
            'Yeelight\Events\UserLoggedOut',
            'Yeelight\Listeners\UserEventListener@onUserLogout'
        );*/
    }
}
