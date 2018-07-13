<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

class WorkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.work.php' => config_path('ore.work.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../config/ore.work-log.php' => config_path('ore.work-log.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutes();
        $this->commands([\Railken\LaraOre\Console\Commands\Work\WorkFireCommand::class]);

        config(['ore.permission.managers' => array_merge(Config::get('ore.permission.managers', []), [
            \Railken\LaraOre\Work\WorkManager::class,
            \Railken\LaraOre\WorkLog\WorkLogManager::class,
        ])]);
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Railken\LaraOre\TemplateServiceProvider::class);
        $this->app->register(\Railken\LaraOre\FileServiceProvider::class);
        $this->app->register(\Railken\LaraOre\UserServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.work.php', 'ore.work');
        $this->mergeConfigFrom(__DIR__.'/../config/ore.work-log.php', 'ore.work-log');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        Router::group(Config::get('ore.work.http.router'), function ($router) {
            $controller = Config::get('ore.work.http.controller');

            $router->get('/', ['uses' => $controller.'@index']);
            $router->post('/', ['uses' => $controller.'@create']);
            $router->put('/{id}', ['uses' => $controller.'@update']);
            $router->delete('/{id}', ['uses' => $controller.'@remove']);
            $router->get('/{id}', ['uses' => $controller.'@show']);
        });

        Router::group(Config::get('ore.work-log.http.router'), function ($router) {
            $controller = Config::get('ore.work-log.http.controller');

            $router->get('/', ['uses' => $controller.'@index']);
            $router->post('/', ['uses' => $controller.'@create']);
            $router->put('/{id}', ['uses' => $controller.'@update']);
            $router->delete('/{id}', ['uses' => $controller.'@remove']);
            $router->get('/{id}', ['uses' => $controller.'@show']);
        });
    }
}
