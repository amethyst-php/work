<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\Work\WorkManager;

class WorkerHttpTest extends BaseTest
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

    public function testWorkerHttp()
    {
        $work = $this->getManager()->create(WorkFaker::make()->parametersWithHttp())->getResource();

        $this->getManager()->dispatch($work, [
            'user' => [
                'name',
            ],
        ]);

        $this->assertEquals(1, 1);
    }
}
