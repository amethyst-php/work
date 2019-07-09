<?php

namespace Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class WorkAuthorizer extends Authorizer
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
