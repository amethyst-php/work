<?php

namespace Railken\LaraOre\Work\Attributes\Worker\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkWorkerNotDefinedException extends WorkAttributeException
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
    protected $code = 'WORK_WORKER_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
