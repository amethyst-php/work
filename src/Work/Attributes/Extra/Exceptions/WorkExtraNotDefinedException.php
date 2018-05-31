<?php

namespace Railken\LaraOre\Work\Attributes\Extra\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkExtraNotDefinedException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'extra';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_EXTRA_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
