<?php

namespace Railken\LaraOre\WorkLog\Attributes\Payload\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogPayloadNotValidException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'payload';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_PAYLOAD_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
