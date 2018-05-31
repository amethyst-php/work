<?php

namespace Railken\LaraOre\Work\Tests;

use Illuminate\Support\Facades\File;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\Laravel\Manager\ManagerServiceProvider::class,
            \Railken\LaraOre\WorkServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        File::cleanDirectory(database_path("migrations/"));

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\WorkServiceProvider',
            '--force' => true
        ]);

        $this->artisan('migrate:fresh');
        $this->artisan('migrate');
    }
}
