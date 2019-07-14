<?php

namespace Amethyst\Providers;

use Amethyst\Api\Support\Router;
use Amethyst\Common\CommonServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class WorkServiceProvider extends CommonServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();
        $this->loadExtraRoutes();

        $this->app->register(\Amethyst\Providers\DataBuilderServiceProvider::class);
    }

    /**
     * Load extras routes.
     */
    public function loadExtraRoutes()
    {
        $config = Config::get('amethyst.work.http.admin.work');

        if (Arr::get($config, 'enabled')) {
            Router::group('admin', Arr::get($config, 'router'), function ($router) use ($config) {
                $controller = Arr::get($config, 'controller');

                $router->post('/{id}/execute', ['as' => 'execute', 'uses' => $controller.'@execute'])->where(['id' => '[0-9]+']);
            });
        }
    }
}
