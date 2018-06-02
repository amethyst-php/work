<?php

namespace Railken\LaraOre;

use Illuminate\Support\ServiceProvider;

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

        if (!class_exists('CreateWorksTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_works_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_works_table.php'),
            ], 'migrations');
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\TemplateServiceProvider::class);
        $this->app->register(\Railken\LaraOre\FileServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.work.php', 'ore.work');
    }
}
