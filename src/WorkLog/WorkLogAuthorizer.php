<?php

namespace Railken\LaraOre\WorkLog;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class WorkLogAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'work_log.create',
        Tokens::PERMISSION_UPDATE => 'work_log.update',
        Tokens::PERMISSION_SHOW   => 'work_log.show',
        Tokens::PERMISSION_REMOVE => 'work_log.remove',
    ];
}
