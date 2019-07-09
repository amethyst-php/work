<?php

namespace Amethyst\Workers;

use Amethyst\Models\Work;

class BaseWorker implements WorkerContract
{
    public function log(Work $work, array $parameters)
    {
    }
}
