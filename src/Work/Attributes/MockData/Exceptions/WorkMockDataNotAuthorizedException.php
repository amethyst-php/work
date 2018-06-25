<?php

namespace Railken\LaraOre\Work\Attributes\MockData\Exceptions;

use Railken\LaraOre\Work\Exceptions\WorkAttributeException;

class WorkMockDataNotAuthorizedException extends WorkAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'mock_data';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'WORK_MOCK_DATA_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
