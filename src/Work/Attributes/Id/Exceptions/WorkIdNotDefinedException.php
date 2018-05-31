<?php

namespace Railken\LaraOre\Work\Attributes\Id\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkIdNotDefinedException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_ID_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
