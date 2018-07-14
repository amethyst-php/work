<?php

namespace Railken\LaraOre\WorkLog\Attributes\WorkName\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogWorkNameNotDefinedException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'work_name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_WORK_NAME_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
