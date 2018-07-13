<?php

namespace Railken\LaraOre\WorkLog\Attributes\Extra\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogExtraNotUniqueException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_EXTRA_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
