<?php

namespace Railken\LaraOre\WorkLog\Attributes\Data\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogDataNotDefinedException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_DATA_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
