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
        \Railken\LaraOre\Workers\EmailWorker::class,
        \Railken\LaraOre\Workers\FileWorker::class,
    ],

    'router' => [
        'prefix'      => '/admin/works',
    ],

];
