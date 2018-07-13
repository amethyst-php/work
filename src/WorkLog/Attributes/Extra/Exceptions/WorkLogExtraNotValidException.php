<?php

namespace Railken\LaraOre\WorkLog\Attributes\Extra\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogExtraNotValidException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_EXTRA_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
