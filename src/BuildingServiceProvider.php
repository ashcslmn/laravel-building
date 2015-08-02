<?php

namespace Metrique\Building;

use Illuminate\Support\ServiceProvider;
use Metrique\Building\Building;
use Metrique\Building\Commands\BuildingMigrationsCommand;
use Metrique\Building\Commands\BuildingSeedsCommand;
use Metrique\Building\Contracts\BlockTypeRepositoryInterface;
use Metrique\Building\BlockTypeRepositoryEloquent;

class BuildingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    // protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {           
        // Commands
        $this->commands('command.metrique.migrate-building');
        $this->commands('command.metrique.seed-building');

        // Views
        $this->loadViewsFrom(__DIR__.'/Resources/views/', 'metrique-building');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Facade
        $this->registerBuildingFacade();

        // Repositories
        $this->registerBlockTypeRepository();

        // Commands
        $this->registerCommands();
    }

    /**
     * Register the Building Facade
     * 
     * @return void
     */
    private function registerBuildingFacade()
    {
        $this->app->bind('\Metrique\Building\Building', function() {
            return new Building($this->app);
        });
    }

    private function registerBlockTypeRepository()
    {
        $this->app->bind(
            '\Metrique\Building\Contracts\BlockTypeRepositoryInterface',
            '\Metrique\Building\BlockTypeRepositoryEloquent',
        });
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->bindShared('command.metrique.migrate-building', function($app) {
            return new BuildingMigrationsCommand();
        });

        $this->app->bindShared('command.metrique.seed-building', function($app) {
            return new BuildingSeedsCommand();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Metrique\Building\Contracts\BlockTypeRepositoryInterface'
        ];
    }


}