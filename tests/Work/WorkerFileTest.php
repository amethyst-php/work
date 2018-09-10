<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\LaraOre\FileGenerator\FileGeneratorFaker;
use Railken\LaraOre\FileGenerator\FileGeneratorManager;
use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\Work\WorkManager;

class WorkerFileTest extends BaseTest
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
