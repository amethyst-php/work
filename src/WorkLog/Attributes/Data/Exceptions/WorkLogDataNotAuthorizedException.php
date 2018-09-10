<?php

namespace Railken\LaraOre\WorkLog\Attributes\Data\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogDataNotAuthorizedException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'data';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_DATA_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
