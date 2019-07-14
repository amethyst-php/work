<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Amethyst\Jobs\ProcessWork;
use Amethyst\Models\Work;
use Railken\Lem\Manager;
use Railken\Lem\Result;

/**
 * @method \Amethyst\Models\Work newEntity()
 * @method \Amethyst\Schemas\WorkSchema getSchema()
 * @method \Amethyst\Repositories\WorkRepository getRepository()
 * @method \Amethyst\Serializers\WorkSerializer getSerializer()
 * @method \Amethyst\Validators\WorkValidator getValidator()
 * @method \Amethyst\Authorizers\WorkAuthorizer getAuthorizer()
 */
class WorkManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.work.data.work';

    /**
     * @alias execute
     */
    public function dispatch(Work $work, array $data = [])
    {
        return $this->execute($work, $data);
    }

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
