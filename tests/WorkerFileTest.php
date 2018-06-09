<?php

namespace Railken\LaraOre\Work\Tests;

use Railken\Bag;
use Railken\LaraOre\Work\Work;
use Railken\LaraOre\Work\WorkManager;

class WorkerFileTest extends BaseTest
{
    use Traits\CommonTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new WorkManager();
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new bag();
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\FileWorker');
        $bag->set('extra', [
            'filename' => "{{ 'now'|date('Y-m-d') }}.pdf",
            'filetype' => 'application/pdf',
            'content'  => '{{ message }}',
            'tags'     => 'pdf,hello,invoice',
        ]);

        return $bag;
    }

    public function testWorkerFile1()
    {
        $result = $this->getManager()->create($this->getParameters());

        $this->assertEquals(true, $result->ok());

        $work = $result->getResource();

        $this->getManager()->dispatch($work, [
            'message' => 'Hello',
        ]);
    }

    public function testWorkerFile2()
    {
        $result = $this->getManager()->create($this->getParameters());
        $result = $this->getManager()->create($this->getParameters());

        $this->assertEquals(true, $result->ok());

        $work = $result->getResource();

        $this->getManager()->dispatch($work, [
            '__model' => ['id' => 1, 'type' => Work::class],
            'message' => 'Hello',
        ]);
    }
}
