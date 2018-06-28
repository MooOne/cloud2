<?php

namespace Yeelight\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider
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
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Yeelight\Models' => 'Yeelight\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        // Token Lifetimes
//        Passport::tokensExpireIn(Carbon::now()->addDays(15));

        // Refresh Token Lifetimes
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        // Pruning Revoked Tokens
//        Passport::pruneRevokedTokens();

        // Token Scopes
//        Passport::tokensCan([
//            'place-orders' => 'Place orders',
//            'check-status' => 'Check order status',
//        ]);
    }
}
