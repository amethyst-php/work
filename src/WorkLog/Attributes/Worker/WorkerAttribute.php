<?php

namespace Railken\LaraOre\WorkLog\Attributes\Worker;

use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class WorkerAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'worker';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = true;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\WorkLogWorkerNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkLogWorkerNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkLogWorkerNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkLogWorkerNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'worklog.attributes.worker.fill',
        Tokens::PERMISSION_SHOW => 'worklog.attributes.worker.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     * @param mixed                                             $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return in_array($value, Config::get('ore.work.workers'));
    }
}
