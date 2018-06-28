<?php

namespace Yeelight\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
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
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(base_path('vendor/prettus/l5-repository/src/resources/config/repository.php'), 'repository');

        $this->loadTranslationsFrom(base_path('vendor/prettus/l5-repository/src/resources/lang'), 'repository');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands('Yeelight\Generators\Commands\RepositoryCommand');
        $this->commands('Yeelight\Generators\Commands\TransformerCommand');
        $this->commands('Yeelight\Generators\Commands\PresenterCommand');
        $this->commands('Yeelight\Generators\Commands\EntityCommand');
        $this->commands('Yeelight\Generators\Commands\ValidatorCommand');
        $this->commands('Yeelight\Generators\Commands\ControllerCommand');
        $this->commands('Yeelight\Generators\Commands\ApiControllerCommand');
        $this->commands('Yeelight\Generators\Commands\RequestCommand');
        $this->commands('Yeelight\Generators\Commands\BindingsCommand');
        $this->commands('Yeelight\Generators\Commands\CriteriaCommand');
        $this->commands('Yeelight\Generators\Commands\ViewsCommand');
        $this->commands('Yeelight\Generators\Commands\LangCommand');

        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminUserRepository::class, \Yeelight\Repositories\Eloquent\AdminUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRoleRepository::class, \Yeelight\Repositories\Eloquent\AdminRoleRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminPermissionRepository::class, \Yeelight\Repositories\Eloquent\AdminPermissionRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminMenuRepository::class, \Yeelight\Repositories\Eloquent\AdminMenuRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminOperationLogRepository::class, \Yeelight\Repositories\Eloquent\AdminOperationLogRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\UserRepository::class, \Yeelight\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\SocialiteUserRepository::class, \Yeelight\Repositories\Eloquent\SocialiteUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\ProductModelRepository::class, \Yeelight\Repositories\Eloquent\ProductModelRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\ProductModelRepository::class, \Yeelight\Repositories\Eloquent\ProductModelRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
