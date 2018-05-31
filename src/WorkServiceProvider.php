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
            __DIR__.'/../config/ore.works.php' => config_path('ore.works.php'),
        ], 'config');

        if (!class_exists('CreateWorksTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_works_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_works_table.php'),
            ], 'migrations');
        }
    }
}
