<?php

namespace Railken\LaraOre\Work\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkCreatedAtNotUniqueException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'created_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_CREATED_AT_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
