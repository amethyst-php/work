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

        return $bag;
    }

    public function testSuccessCommon()
    {
        $this->commonTest(new WorkManager(), $this->getParameters());
    }
}
