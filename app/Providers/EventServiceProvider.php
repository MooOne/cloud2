<?php

namespace Yeelight\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 *
 * @category Yeelight
 *
 * @package Yeelight\Providers
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
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
