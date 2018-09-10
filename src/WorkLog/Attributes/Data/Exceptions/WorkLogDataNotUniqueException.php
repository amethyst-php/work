<?php

namespace Railken\LaraOre\WorkLog\Attributes\Data\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogDataNotUniqueException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'data';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_DATA_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
