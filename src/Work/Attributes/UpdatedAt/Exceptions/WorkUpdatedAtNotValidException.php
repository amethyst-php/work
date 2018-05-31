<?php

namespace Railken\LaraOre\Work\Attributes\UpdatedAt\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkUpdatedAtNotValidException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'updated_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_UPDATED_AT_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
