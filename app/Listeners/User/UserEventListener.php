<?php

namespace Yeelight\Listeners\User;

use Yeelight\Events\User\UserLoggedInEvent;
use Yeelight\Events\User\UserRegisteredEvent;

class UserEventListener
{
    public function __construct()
    {
    }

    /**
     * Handle user login events.
     *
     * @param UserLoggedInEvent $event
     */
    public function onUserLogin(UserLoggedInEvent $event)
    {
    }

    /**
     * Handle user registered events.
     *
     * @param UserRegisteredEvent $event
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
     * @param \Illuminate\Events\Dispatcher $events
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

//        $events->listen(
//            'Yeelight\Events\UserLoggedOut',
//            'Yeelight\Listeners\UserEventListener@onUserLogout'
//        );
    }
}
