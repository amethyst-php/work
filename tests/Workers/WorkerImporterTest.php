<?php

namespace Railken\Amethyst\Tests\Workers;

use Railken\Amethyst\Fakers\ImporterFaker;
use Railken\Amethyst\Fakers\WorkFaker;
use Railken\Amethyst\Managers\ImporterManager;
use Railken\Amethyst\Managers\WorkManager;
use Railken\Amethyst\Tests\BaseTest;
use Symfony\Component\Yaml\Yaml;

class WorkerImporterTest extends BaseTest
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

    public function testWorkerNotification()
    {
        $esm = new ImporterManager();
        $es = $esm->create(ImporterFaker::make()->parameters()->set('targets', 1)->set('message', '{{ user.name }}'))->getResource();

        $work = $this->getManager()->create(WorkFaker::make()->parameters()->set('payload', Yaml::dump([
            'class' => 'Railken\Amethyst\Workers\NotificationWorker',
            'data'  => [
                'id' => $es->id,
            ],
        ])))->getResource();

        $result = $this->getManager()->dispatch($work, [
            'user' => [
                'email' => 'test@test.net',
                'name'  => 'hello',
            ],
        ]);

        $this->assertEquals(true, $result->ok());
    }
}
