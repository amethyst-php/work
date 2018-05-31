<?php

namespace Railken\LaraOre\Work;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class WorkAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'work.create',
        Tokens::PERMISSION_UPDATE => 'work.update',
        Tokens::PERMISSION_SHOW   => 'work.show',
        Tokens::PERMISSION_REMOVE => 'work.remove',
    ];
}
