<?php

namespace Railken\LaraOre\WorkLog\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogCreatedAtNotValidException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_CREATED_AT_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
