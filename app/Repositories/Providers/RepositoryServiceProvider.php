<?php
namespace Yeelight\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package Yeelight\Repositories\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(base_path('vendor/prettus/l5-repository/src/resources/config/repository.php'), 'repository');

        $this->loadTranslationsFrom(base_path('vendor/prettus/l5-repository/src/resources/lang'), 'repository');
    }


    /**
     * Register the service provider.
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
