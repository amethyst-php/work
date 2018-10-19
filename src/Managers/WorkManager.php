<?php

namespace Railken\Amethyst\Managers;

use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Amethyst\Jobs\ProcessWork;
use Railken\Amethyst\Models\Work;
use Railken\Lem\Manager;

class WorkManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.work.data.work';

    /**
     * Dispatch a work.
     *
     * @param Work  $work
     * @param array $data
     */
    public function dispatch(Work $work, array $data = [])
    {
        dispatch(new ProcessWork($work, $data));
    }
}
