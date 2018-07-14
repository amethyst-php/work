<?php

namespace Railken\LaraOre\WorkLog\Attributes\WorkName\Exceptions;

use Railken\LaraOre\WorkLog\Exceptions\WorkLogAttributeException;

class WorkLogWorkNameNotAuthorizedException extends WorkLogAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'work_name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_WORK_NAME_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
