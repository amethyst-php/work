<?php

namespace Railken\LaraOre\Work\Tests;

use Railken\Bag;
use Railken\LaraOre\Work\WorkManager;
use Railken\LaraOre\Work\WorkFaker;

class WorkerEmailTest extends BaseTest
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
        $work = $this->getManager()->create(WorkFaker::make()->parametersWithEmail())->getResource();

        $this->getManager()->dispatch($work, [
            'user' => [
                'email' => 'test@test.net',
                'name'  => 'test',
            ],
            'message' => 'text',
        ]);

        $this->assertEquals(1, 1);
    }
}
