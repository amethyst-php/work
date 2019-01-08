<?php

namespace Railken\Amethyst\Tests\Workers;

use Railken\Amethyst\Fakers\FileGeneratorFaker;
use Railken\Amethyst\Fakers\WorkFaker;
use Railken\Amethyst\Managers\FileGeneratorManager;
use Railken\Amethyst\Managers\WorkManager;
use Railken\Amethyst\Tests\BaseTest;
use Symfony\Component\Yaml\Yaml;

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

        $fg = $fgm->create(FileGeneratorFaker::make()
            ->parameters()
            ->set('body', '{{ message }}')
        )->getResource();

        $result = $this->getManager()->create(WorkFaker::make()->parameters()->set('payload', Yaml::dump([
            'class' => 'Railken\Amethyst\Workers\FileWorker',
            'data'  => [
                'id' => $fg->id,
            ],
        ])));

        $work = $result->getResource();

        $this->getManager()->dispatch($work, [
            'message' => 'Hello',
        ]);
    }
}
