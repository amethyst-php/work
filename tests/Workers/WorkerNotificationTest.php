<?php

namespace Amethyst\Tests\Workers;

use Amethyst\Fakers\NotificationSenderFaker;
use Amethyst\Fakers\WorkFaker;
use Amethyst\Managers\NotificationSenderManager;
use Amethyst\Managers\WorkManager;
use Amethyst\Tests\BaseTest;
use Symfony\Component\Yaml\Yaml;

class WorkerNotificationTest extends BaseTest
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
        $esm = new NotificationSenderManager();
        $es = $esm->create(NotificationSenderFaker::make()->parameters()->set('targets', 1)->set('message', '{{ user.name }}'))->getResource();

        $work = $this->getManager()->create(WorkFaker::make()->parameters()->set('payload', Yaml::dump([
            'class' => 'Amethyst\Workers\NotificationWorker',
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
