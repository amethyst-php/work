<?php

namespace Railken\LaraOre\Work\Tests;

use Railken\Bag;
use Railken\LaraOre\Work\WorkManager;

class WorkTest extends BaseTest
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
        $bag->set('name', 'a common name');
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');

        return $bag;
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }


    public function testWorkerEmail()
    {
        $resource = $this->getManager()->create($this->getParameters())->getResource();
        $this->assertEquals(1, 1);
    }
}
