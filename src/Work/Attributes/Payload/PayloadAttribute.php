<?php

namespace Railken\LaraOre\Work\Attributes\Payload;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class PayloadAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'payload';

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
        Tokens::NOT_DEFINED    => Exceptions\WorkPayloadNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkPayloadNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkPayloadNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkPayloadNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'work.attributes.payload.fill',
        Tokens::PERMISSION_SHOW => 'work.attributes.payload.show',
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
