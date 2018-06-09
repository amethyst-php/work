<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    | This is the table used to save disks to the database
    |
    */
    'table' => 'ore_works',

    'workers' => [
        [
            'worker' => \Railken\LaraOre\Workers\EmailWorker::class,
            'data'   => [
                'to', 'body', 'subject',
            ],
        ],
        [
            'worker' => \Railken\LaraOre\Workers\FileWorker::class,
            'data'   => [
                'filename', 'filetype', 'content', 'tags',
            ],
        ],
    ],

    'router' => [
        'prefix' => 'admin/works',
        'middlewares' => [
            \Railken\LaraOre\RequestLoggerMiddleware::class,
            'auth:api',
        ]
    ]

];
