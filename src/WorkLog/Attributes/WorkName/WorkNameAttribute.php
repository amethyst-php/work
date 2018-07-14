<?php

namespace Railken\LaraOre\WorkLog\Attributes\WorkName;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class WorkNameAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'work_name';

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
        Tokens::NOT_DEFINED    => Exceptions\WorkLogWorkNameNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkLogWorkNameNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkLogWorkNameNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkLogWorkNameNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'worklog.attributes.work_name.fill',
        Tokens::PERMISSION_SHOW => 'worklog.attributes.work_name.show',
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
        return v::length(1, 255)->validate($value);
    }
}
