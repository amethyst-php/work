<?php

namespace Railken\LaraOre\Work\Tests;

use Railken\Bag;
use Railken\LaraOre\Work\WorkManager;
use Railken\LaraOre\Work\WorkFaker;

class CommandsTest extends BaseTest
{
    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new WorkManager();
    }
    
    public function testWorkerEmail()
    {
        $result = $this->getManager()->create(WorkFaker::make());

        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $result = $this->artisan('lara-ore:work:fire', ['id' => $resource->id]);
    }
}
