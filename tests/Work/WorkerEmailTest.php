<?php

namespace Railken\LaraOre\Tests\Work;

use Railken\Bag;
use Railken\LaraOre\Work\WorkManager;
use Railken\LaraOre\Work\WorkFaker;
use Railken\LaraOre\File\FileManager;

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
        $work = $this->getManager()->create(WorkFaker::make()->parametersWithEmail())->getResource();

        $fm = new FileManager();
        $result = $fm->uploadFileByContent("hello my friend", "welcome.txt");
        $file = $result->getResource();

        $this->getManager()->dispatch($work, [
            'user' => [
                'email' => 'test@test.net',
                'name'  => 'test',
            ],
            'message' => 'text',
            'file' => $file
        ]);

        $this->assertEquals(1, 1);
    }
}
