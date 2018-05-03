<?php
namespace Yeelight\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Yeelight\Events\Event' => [
            'Yeelight\Listeners\EventListener',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'Yeelight\Listeners\Auth\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'Yeelight\Listeners\Auth\PruneOldTokens',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
