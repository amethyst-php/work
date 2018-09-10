<?php

namespace Railken\LaraOre\WorkLog\Attributes\Payload\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogPayloadNotAuthorizedException extends WorkLogAttributeException
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
    protected $code = 'WORKLOG_PAYLOAD_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
