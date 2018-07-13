<?php

namespace Railken\LaraOre\WorkLog\Exceptions;

class WorkLogNotAuthorizedException extends WorkLogException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
