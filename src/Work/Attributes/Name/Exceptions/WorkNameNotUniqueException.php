<?php

namespace Railken\LaraOre\Work\Attributes\Name\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkNameNotUniqueException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_NAME_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
