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
        $bag->set('name', 'El. psy. congroo. '.microtime(true));
        $bag->set('worker', 'Railken\LaraOre\Workers\EmailWorker');
        $bag->set('extra', [
            'to'      => '{{ user.email }}',
            'subject' => 'Welcome to the laboratory lab {{ user.name }}',
            'body'    => '{{ message }}',
        ]);

        return $bag;
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }
}
