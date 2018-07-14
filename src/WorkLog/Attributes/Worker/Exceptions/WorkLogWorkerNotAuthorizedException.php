<?php

namespace Railken\LaraOre\WorkLog\Attributes\Worker\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogWorkerNotAuthorizedException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_WORKER_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
