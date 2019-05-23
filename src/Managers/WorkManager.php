<?php

namespace Railken\Amethyst\Managers;

use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Amethyst\Jobs\ProcessWork;
use Railken\Amethyst\Models\Work;
use Railken\Lem\Manager;
use Railken\Lem\Result;

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
    public function execute(Work $work, array $data = [])
    {
        $result = new Result();

        if (!$result->ok()) {
            return $result;
        }

        dispatch(new ProcessWork($work, $data));

        return $result;
    }

    /**
     * Describe extra actions.
     *
     * @return array
     */
    public function getDescriptor()
    {
        return [
            'actions' => [
                'executor',
            ],
        ];
    }
}
