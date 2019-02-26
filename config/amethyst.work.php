<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    |
    | Here you can change the table name and the class components.
    |
    */
    'data' => [
        'work' => [
            'table'      => 'amethyst_works',
            'comment'    => 'Work',
            'model'      => Railken\Amethyst\Models\Work::class,
            'schema'     => Railken\Amethyst\Schemas\WorkSchema::class,
            'repository' => Railken\Amethyst\Repositories\WorkRepository::class,
            'serializer' => Railken\Amethyst\Serializers\WorkSerializer::class,
            'validator'  => Railken\Amethyst\Validators\WorkValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\WorkAuthorizer::class,
            'faker'      => Railken\Amethyst\Fakers\WorkFaker::class,
            'manager'    => Railken\Amethyst\Managers\WorkManager::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Http configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the routes
    |
    */
    'http' => [
        'admin' => [
            'work' => [
                'enabled'    => true,
                'controller' => Railken\Amethyst\Http\Controllers\Admin\WorksController::class,
                'router'     => [
                    'as'     => 'work.',
                    'prefix' => '/works',
                ],
            ],
        ],
    ],
];
