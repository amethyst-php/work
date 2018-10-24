<?php

namespace Railken\Amethyst\Providers;

use Railken\Amethyst\Common\CommonServiceProvider;

class WorkServiceProvider extends CommonServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

        $this->app->register(\Railken\Amethyst\Providers\EmailSenderServiceProvider::class);
        $this->app->register(\Railken\Amethyst\Providers\FileGeneratorServiceProvider::class);
        $this->app->register(\Railken\Amethyst\Providers\DataBuilderServiceProvider::class);
    }
}
