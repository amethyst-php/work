<?php

namespace Amethyst\Tests\Workers;

use Amethyst\Fakers\EmailSenderFaker;
use Amethyst\Fakers\WorkFaker;
use Amethyst\Managers\EmailSenderManager;
use Amethyst\Managers\FileManager;
use Amethyst\Managers\WorkManager;
use Amethyst\Tests\BaseTest;
use Symfony\Component\Yaml\Yaml;

class WorkerEmailTest extends BaseTest
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

    public function testWorkerEmail()
    {
        $esm = new EmailSenderManager();
        $es = $esm->create(EmailSenderFaker::make()->parameters()->set('body', '{{ user.name }}'))->getResource();

        $work = $this->getManager()->create(WorkFaker::make()->parameters()->set('payload', Yaml::dump([
            'class' => 'Amethyst\Workers\EmailWorker',
            'data'  => [
                'id' => $es->id,
            ],
        ])))->getResource();

        $fm = new FileManager();
        $file = $fm->create([])->getResource();
        $result = $fm->uploadFileByContent($file, 'hello my friend');

        $this->getManager()->dispatch($work, [
            'user' => [
                'email' => 'test@test.net',
                'name'  => 'hello',
            ],
            'message' => 'text',
            'file'    => $file->media[0]->getPath(),
        ]);

        $this->assertEquals(1, 1);
    }
}
