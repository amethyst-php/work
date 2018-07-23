<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\Work\WorkManager;

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
        $result = $this->getManager()->create(WorkFaker::make()->parameters());

        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $result = $this->artisan('lara-ore:work:fire', ['id' => $resource->id]);
    }
}
