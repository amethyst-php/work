<?php

namespace Railken\LaraOre\Workers;

use Railken\Bag;
use Railken\LaraOre\Work\Work;
use Railken\LaraOre\WorkLog\WorkLogManager;

class BaseWorker implements WorkerContract
{
    public function log(Work $work, array $parameters)
    {
        $bag = new Bag();
        $bag->set('work_name', $work->name);

        $manager = new WorkLogManager();
        $manager->create($bag);
    }
}
