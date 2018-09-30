<?php

namespace Railken\Amethyst\Tests\Workers;

use Railken\Amethyst\Fakers\FileGeneratorFaker;
use Railken\Amethyst\Fakers\WorkFaker;
use Railken\Amethyst\Managers\FileGeneratorManager;
use Railken\Amethyst\Managers\WorkManager;
use Railken\Amethyst\Tests\BaseTest;

class WorkerFileTest extends BaseTest
{
    /**
     * Retrieve basic url.
     *
     * @return \Railken\Lem\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new WorkManager();
    }

    public function testWorkerFile()
    {
        $fgm = new FileGeneratorManager();
        $fg = $fgm->create(FileGeneratorFaker::make()->parameters()->set('body', '{{ message }}'))->getResource();

        $result = $this->getManager()->create(WorkFaker::make()->parametersWithFile()->set('payload.data.id', $fg->id));

        $this->assertEquals(true, $result->ok());

        $work = $result->getResource();

        $this->getManager()->dispatch($work, [
            'message' => 'Hello',
        ]);
    }
}
