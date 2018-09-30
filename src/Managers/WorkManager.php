<?php

namespace Railken\Amethyst\Managers;

use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Jobs\ProcessWork;
use Railken\Amethyst\Models\Work;
use Railken\Lem\Manager;

class WorkManager extends Manager
{
    /**
     * Describe this manager.
     *
     * @var string
     */
    public $comment = '...';

    /**
     * Register Classes.
     */
    public function registerClasses()
    {
        return Config::get('amethyst.work.managers.work');
    }

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
