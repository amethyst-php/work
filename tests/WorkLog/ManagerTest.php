<?php

namespace Railken\LaraOre\Tests\WorkLog;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\WorkLog\WorkLogFaker;
use Railken\LaraOre\WorkLog\WorkLogManager;

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
        return new WorkLogManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), WorkLogFaker::make()->parameters());
    }
}
