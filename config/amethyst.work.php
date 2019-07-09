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
            'model'      => Amethyst\Models\Work::class,
            'schema'     => Amethyst\Schemas\WorkSchema::class,
            'repository' => Amethyst\Repositories\WorkRepository::class,
            'serializer' => Amethyst\Serializers\WorkSerializer::class,
            'validator'  => Amethyst\Validators\WorkValidator::class,
            'authorizer' => Amethyst\Authorizers\WorkAuthorizer::class,
            'faker'      => Amethyst\Fakers\WorkFaker::class,
            'manager'    => Amethyst\Managers\WorkManager::class,
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
                'controller' => Amethyst\Http\Controllers\Admin\WorksController::class,
                'router'     => [
                    'as'     => 'work.',
                    'prefix' => '/works',
                ],
            ],
        ],
    ],
];
