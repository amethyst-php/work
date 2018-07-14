<?php

namespace Railken\LaraOre\WorkLog\Attributes\Worker\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogWorkerNotDefinedException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'worker';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_WORKER_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
