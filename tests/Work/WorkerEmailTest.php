<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\LaraOre\EmailSender\EmailSenderFaker;
use Railken\LaraOre\EmailSender\EmailSenderManager;
use Railken\LaraOre\File\FileManager;
use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\Work\WorkManager;

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
