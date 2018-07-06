<?php

namespace Railken\LaraOre\Work\Tests;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\Work\WorkManager;
use Railken\LaraOre\Work\WorkFaker;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new WorkManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), WorkFaker::make()->parameters());
    }
}
