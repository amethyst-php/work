<?php

namespace Railken\LaraOre\Work\Attributes\Extra;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class ExtraAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'extra';

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
        Tokens::NOT_DEFINED    => Exceptions\WorkExtraNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\WorkExtraNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\WorkExtraNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\WorkExtraNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'work.attributes.extra.fill',
        Tokens::PERMISSION_SHOW => 'work.attributes.extra.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param \Railken\LaraOre\Work\Work $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        $worker = new $entity->worker;
        $available = $worker->getData();

        $diff = (new Collection($value))->keys()->diff($available);

        return $diff->count() === 0;
    }

    /**
     * Retrieve default value
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     *
     * @return mixed
     */
    public function getDefault(EntityContract $entity)
    {
        return [];
    }
}
