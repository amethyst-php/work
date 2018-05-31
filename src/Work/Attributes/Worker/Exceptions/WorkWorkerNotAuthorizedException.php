<?php

namespace Railken\LaraOre\Work\Attributes\Worker\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkWorkerNotAuthorizedException extends WorkAttributeException
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
    protected $code = 'WORK_WORKER_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
