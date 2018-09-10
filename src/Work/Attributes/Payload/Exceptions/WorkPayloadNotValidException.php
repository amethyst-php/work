<?php

namespace Railken\LaraOre\Work\Attributes\Payload\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkPayloadNotValidException extends WorkAttributeException
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
    protected $code = 'WORK_PAYLOAD_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
