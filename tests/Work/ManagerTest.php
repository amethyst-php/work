<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\Work\WorkManager;

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
