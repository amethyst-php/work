<?php

namespace Amethyst\Tests\Workers;

use Amethyst\Fakers\FileGeneratorFaker;
use Amethyst\Fakers\WorkFaker;
use Amethyst\Managers\FileGeneratorManager;
use Amethyst\Managers\WorkManager;
use Amethyst\Tests\BaseTest;
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
            'class' => 'Amethyst\Workers\FileWorker',
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
