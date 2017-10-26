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

        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(\Yeelight\Repositories\Interfaces\PostRepository::class, \Yeelight\Repositories\Eloquent\PostRepositoryEloquent::class);
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
