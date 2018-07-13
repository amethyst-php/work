<?php

namespace Railken\LaraOre\WorkLog\Exceptions;

class WorkLogNotFoundException extends WorkLogException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORKLOG_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
