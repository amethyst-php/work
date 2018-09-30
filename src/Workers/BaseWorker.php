<?php

namespace Railken\Amethyst\Workers;

use Railken\Amethyst\Models\Work;

class BaseWorker implements WorkerContract
{
    public function log(Work $work, array $parameters)
    {
    }
}
