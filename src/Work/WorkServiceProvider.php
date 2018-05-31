<?php

namespace Railken\LaraOre\Work;

use Illuminate\Support\ServiceProvider;

class WorkServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        Work::observe(WorkObserver::class);
    }
}
