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
        $bag->set('extra', $parameters);
        $bag->set('work_name', $work->name);
        $bag->set('worker', $work->worker);

        $manager = new WorkLogManager();
        $manager->create($bag);
    }
}
