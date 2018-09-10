<?php

namespace Railken\LaraOre\WorkLog\Attributes\Data;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class DataAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'data';

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
        Tokens::NOT_DEFINED    => Exceptions\WorkLogDataNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkLogDataNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkLogDataNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkLogDataNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'worklog.attributes.data.fill',
        Tokens::PERMISSION_SHOW => 'worklog.attributes.data.show',
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
        return true;
    }
}
