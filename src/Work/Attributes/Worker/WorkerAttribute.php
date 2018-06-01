<?php

namespace Railken\LaraOre\Work\Attributes\Worker;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;

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
    protected $required = false;

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
        Tokens::NOT_DEFINED    => Exceptions\WorkWorkerNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkWorkerNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkWorkerNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkWorkerNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'work.attributes.worker.fill',
        Tokens::PERMISSION_SHOW => 'work.attributes.worker.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return in_array($value, (new Collection(Config::get('ore.work.workers')))->map(function ($v) {
            return $v['worker'];
        })->toArray());
    }
}
