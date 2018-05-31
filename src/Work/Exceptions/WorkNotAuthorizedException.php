<?php

namespace Railken\LaraOre\Work\Exceptions;

class WorkNotAuthorizedException extends WorkException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
