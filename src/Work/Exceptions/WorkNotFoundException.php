<?php

namespace Railken\LaraOre\Work\Exceptions;

class WorkNotFoundException extends WorkException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
