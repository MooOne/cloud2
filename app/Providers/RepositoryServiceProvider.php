<?php
namespace Yeelight\Providers;

use Illuminate\Support\ServiceProvider;
use Yeelight\Repositories\Eloquent\UserRepositoryEloquent;
use Yeelight\Repositories\Interfaces\UserRepository;

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
        $this->commands('Yeelight\Repositories\Generators\Commands\RepositoryCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\TransformerCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\PresenterCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\EntityCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\ValidatorCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\ControllerCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\BindingsCommand');
        $this->commands('Yeelight\Repositories\Generators\Commands\CriteriaCommand');


        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminUserRepository::class, \Yeelight\Repositories\Eloquent\AdminUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRoleRepository::class, \Yeelight\Repositories\Eloquent\AdminRoleRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminPermissionRepository::class, \Yeelight\Repositories\Eloquent\AdminPermissionRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminMenuRepository::class, \Yeelight\Repositories\Eloquent\AdminMenuRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRoleUserRepository::class, \Yeelight\Repositories\Eloquent\AdminRoleUserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRolePermissionRepository::class, \Yeelight\Repositories\Eloquent\AdminRolePermissionRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminRoleMenuRepository::class, \Yeelight\Repositories\Eloquent\AdminRoleMenuRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminUserPermissionRepository::class, \Yeelight\Repositories\Eloquent\AdminUserPermissionRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\AdminOperationLogRepository::class, \Yeelight\Repositories\Eloquent\AdminOperationLogRepositoryEloquent::class);
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
