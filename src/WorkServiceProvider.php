<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

class WorkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.work.php' => config_path('ore.work.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutes();
        $this->commands([\Railken\LaraOre\Console\Commands\Work\WorkFireCommand::class]);

        config(['ore.permission.managers' => array_merge(Config::get('ore.permission.managers', []), [
            \Railken\LaraOre\Work\WorkManager::class,
        ])]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Railken\LaraOre\TemplateServiceProvider::class);
        $this->app->register(\Railken\LaraOre\FileServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.work.php', 'ore.work');
    }

    /**
     * Load routes.
     *
     * @return void
     */
    public function loadRoutes()
    {
        Router::group(Config::get('ore.work.http.router'), function ($router) {
            $controller = Config::get('ore.work.http.controller');
            
            $router->get('/', ['uses' => $controller . '@index']);
            $router->post('/', ['uses' => $controller . '@create']);
            $router->put('/{id}', ['uses' => $controller . '@update']);
            $router->delete('/{id}', ['uses' => $controller . '@remove']);
            $router->get('/{id}', ['uses' => $controller . '@show']);
        });
    }
}
