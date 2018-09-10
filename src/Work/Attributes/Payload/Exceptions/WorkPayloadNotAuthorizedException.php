<?php

namespace Railken\LaraOre\Work\Attributes\Payload\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkPayloadNotAuthorizedException extends WorkAttributeException
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
    protected $code = 'WORK_PAYLOAD_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
