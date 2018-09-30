<?php

namespace Railken\Amethyst\Tests\Workers;

use Railken\Amethyst\Fakers\EmailSenderFaker;
use Railken\Amethyst\Fakers\WorkFaker;
use Railken\Amethyst\Managers\EmailSenderManager;
use Railken\Amethyst\Managers\FileManager;
use Railken\Amethyst\Managers\WorkManager;
use Railken\Amethyst\Tests\BaseTest;

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

        $work = $this->getManager()->create(WorkFaker::make()->parametersWithEmail()->set('payload.data.id', $es->id))->getResource();

        $fm = new FileManager();
        $result = $fm->uploadFileByContent('hello my friend', 'welcome.txt');
        $file = $result->getResource();

        $this->getManager()->dispatch($work, [
            'user' => [
                'email' => 'test@test.net',
                'name'  => 'hello',
            ],
            'message' => 'text',
            'file'    => $file,
        ]);

        $this->assertEquals(1, 1);
    }
}
